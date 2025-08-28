<?php

namespace App\Services;

use InvalidArgumentException;

class FourCharCipher
{
    // Clé secrète - doit contenir uniquement des caractères A-Z0-9
    private const KEY = 'K3Y9X2M8';

    // Caractères autorisés en sortie
    private const ALLOWED_CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    public static function encrypt(string $input): string
    {
        if (strlen($input) !== 4) {
            throw new \InvalidArgumentException('Input must be exactly 4 characters long');
        }

        if (!preg_match('/^[A-Z0-9]{4}$/', $input)) {
            throw new \InvalidArgumentException('Input must contain only uppercase letters and digits');
        }

        $result = '';
        for ($i = 0; $i < 4; $i++) {
            $char = $input[$i];
            $keyChar = self::KEY[$i % strlen(self::KEY)];

            // Conversion en valeurs numériques (A=0, B=1, ..., Z=25, 0=26, ..., 9=35)
            $charValue = self::charToValue($char);
            $keyValue = self::charToValue($keyChar);

            // Chiffrement avec décalage et modulo
            $encryptedValue = ($charValue + $keyValue) % 36;

            // Conversion inverse
            $result .= self::valueToChar($encryptedValue);
        }

        return $result;
    }

    public static function decrypt(string $encrypted): string
    {
        if (strlen($encrypted) !== 4) {
            throw new \InvalidArgumentException('Input must be exactly 4 characters long');
        }

        if (!preg_match('/^[A-Z0-9]{4}$/', $encrypted)) {
            throw new \InvalidArgumentException('Input must contain only uppercase letters and digits');
        }

        $result = '';
        for ($i = 0; $i < 4; $i++) {
            $char = $encrypted[$i];
            $keyChar = self::KEY[$i % strlen(self::KEY)];

            // Conversion en valeurs numériques
            $charValue = self::charToValue($char);
            $keyValue = self::charToValue($keyChar);

            // Déchiffrement avec décalage inverse
            $decryptedValue = ($charValue - $keyValue + 36) % 36;

            // Conversion inverse
            $result .= self::valueToChar($decryptedValue);
        }

        return $result;
    }

    private static function charToValue(string $char): int
    {
        if (ctype_digit($char)) {
            return 26 + (int)$char; // 0=26, 1=27, ..., 9=35
        }
        return ord($char) - ord('A'); // A=0, B=1, ..., Z=25
    }

    private static function valueToChar(int $value): string
    {
        if ($value >= 26) {
            return (string)($value - 26); // Retourne un chiffre 0-9
        }
        return chr($value + ord('A')); // Retourne une lettre A-Z
    }

    public static function validateLicense($nombre1, $nombre2, $nombre3, $chaine): bool
    {
        $currentYear = (int)date('Y');

        // 1. Validation des jours (01-31)
        $jours = (int)substr($nombre1, -2);
        if ($jours < 1 || $jours > 31) {
            throw new InvalidArgumentException("Les 2 derniers chiffres du 1er nombre doivent être entre 01 et 31 (jours)");
        }

        // 2. Validation des mois (01-12)
        $mois = (int)substr($nombre2, -2);
        if ($mois < 1 || $mois > 12) {
            throw new InvalidArgumentException("Les 2 derniers chiffres du 2ème nombre doivent être entre 01 et 12 (mois)");
        }

        // 3. Validation de l'année (>= année courante)
        if ((int)$nombre3 < $currentYear) {
            throw new InvalidArgumentException("Le 3ème nombre doit être supérieur ou égal à l'année courante ($currentYear)");
        }

        // 4. Validation du code (STDR, PREN ou ENTP)
        if (!in_array($chaine, ['STDR', 'PREN', 'ENTP'], true)) {
            throw new InvalidArgumentException("La chaîne doit être STDR, PREN ou ENTP");
        }

        // Validation avancée des dates
        if (in_array($mois, [4, 6, 9, 11]) && $jours > 30) {
            throw new InvalidArgumentException("Le mois $mois ne comporte que 30 jours maximum");
        }

        // Vérification spéciale pour février
        if ($mois == 2) {
            $isLeapYear = ($nombre3 % 4 == 0 && ($nombre3 % 100 != 0 || $nombre3 % 400 == 0));
            if ($jours > ($isLeapYear ? 29 : 28)) {
                throw new InvalidArgumentException("Février $nombre3 ne comporte que ".($isLeapYear ? 29 : 28)." jours");
            }
        }

        return true;
    }

}
