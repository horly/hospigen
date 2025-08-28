<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckRequest;
use App\Models\Licence;
use App\Services\FourCharCipher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use InvalidArgumentException;

class LicenceController extends Controller
{
    //
    public function add_licence()
    {
        return view('licence.add_licence');
    }

    public function generate_license()
    {
        return view('licence.generate_license');
    }

    public function save_license(Request $request, CheckRequest $requetForm)
    {
        //dd($requetForm->all());
        // Exemple d'utilisation
        $day = $requetForm->input('license-day');
        $month = $requetForm->input('license-month');
        $year = $requetForm->input('license-year');
        $type = $requetForm->input('license-type');

        $dayDecypt = FourCharCipher::decrypt($day);
        $monthDecypt = FourCharCipher::decrypt($month);
        $yearDecypt = FourCharCipher::decrypt($year);
        $typeDecypt = FourCharCipher::decrypt($type);

        try {
            $isValid = FourCharCipher::validateLicense(
                $dayDecypt,  // Jours (25)
                $monthDecypt,  // Mois (08)
                $yearDecypt,   // Année
                $typeDecypt    // Code
            );

            if ($isValid) {
                //dd("Validation réussie!");
                // Exécuter votre code ici...

                // Extraction des valeurs
                $dayValue = substr($dayDecypt, -2);    // ex : "01"
                $monthValue = substr($monthDecypt, -2); // ex : "12"
                $yearValue = $yearDecypt;              // ex : "2030" (on garde tel quel)

                // Création de la date
                $expirationDate = Carbon::createFromFormat('Y-m-d', "$yearValue-$monthValue-$dayValue");

                // Mapping des codes vers les valeurs textuelles
                $typeMapping = [
                    'STDR' => 'standard',
                    'PREN' => 'premium',
                    'ENTP' => 'entreprise'
                ];

                if(Carbon::now()->greaterThan($expirationDate))
                {
                    return redirect()->back()
                        ->with('danger', __('licence.the_key_you_entered_is_incorrect_or_has_already_expired'))
                        ->withInput();
                }
                else
                {
                    Licence::first()?->delete(); //On supprime la licence existante

                    $typeText = $typeMapping[$typeDecypt];

                    Licence::create([
                        'cle_licence' =>  $day . "-" . $month . "-" . $year . "-" . $type,
                        'date_debut' =>  date('Y-m-d'),
                        'date_expiration' =>  $expirationDate,
                        'type_licence' =>  $typeText,
                    ]);

                    return redirect()->route('login')
                        ->with('success', __('licence.license_successfully_added'));
                }
            }
        } catch (InvalidArgumentException $e) {
            //dd("Erreur: ".$e->getMessage());
            return redirect()->back()
                ->with('danger', __('licence.the_key_you_entered_is_incorrect_or_has_already_expired'))
                ->withInput();
        }
    }

    public function create_licence(CheckRequest $requetForm)
    {
        $day = $requetForm->input('license-day');
        $month = $requetForm->input('license-month');
        $year = $requetForm->input('license-year');
        $type = $requetForm->input('license-type');

        $dayEncypt = FourCharCipher::encrypt($day);
        $monthEncypt = FourCharCipher::encrypt($month);
        $yearEncypt = FourCharCipher::encrypt($year);
        $typeEncypt = FourCharCipher::encrypt($type);

        $dayDecypt = FourCharCipher::decrypt($dayEncypt);
        $monthDecypt = FourCharCipher::decrypt($monthEncypt);
        $yearDecypt = FourCharCipher::decrypt($yearEncypt);
        $typeDecypt = FourCharCipher::decrypt($typeEncypt);

        dd("Encrypted : " . $dayEncypt . "-" . $monthEncypt . "-" . $yearEncypt . "-" . $typeEncypt . "\n" .
            "Decrypted : " . $dayDecypt . "-" . $monthDecypt . "-" . $yearDecypt . "-" . $typeDecypt);
    }
}
