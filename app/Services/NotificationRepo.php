<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\ReadNotif;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationRepo
{
    public static function setNotification($description, $url)
    {
        //on récupère juste le chemin sans le domaine
        $route = parse_url($url, PHP_URL_PATH);

        $notif = Notification::create([
            'description' => $description,
            'link' => $route,
            'id_user' => Auth::user()->id,
        ]);

        $users = DB::table('users')->get();

        foreach($users as $user)
        {
            ReadNotif::create([
                'id_notif' => $notif->id,
                'id_user' => $user->id,
                'id_sender' => Auth::user()->id,
            ]);
        }
    }

    public static function setNotificationSpecificUsr($description, $url, $id_user)
    {
        //on récupère juste le chemin sans le domaine
        $route = parse_url($url, PHP_URL_PATH);

        $notif = Notification::create([
            'description' => $description,
            'link' => $route,
            'id_user' => Auth::user()->id,
        ]);

        ReadNotif::create([
            'id_notif' => $notif->id,
            'id_user' => $id_user,
            'id_sender' => Auth::user()->id,
        ]);

    }
}
