<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ReadNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //
    public function main()
    {
        return view("main.main");
    }

    public function read_notification(Request $request)
    {
        $id = $request->input('id_element');

        $readNotif = ReadNotif::where('id', $id)->first();
        $notification = Notification::where('id', $readNotif->id_notif)->first();
        $hostwithHttp = request()->getSchemeAndHttpHost();

        $route = $hostwithHttp . $notification->link;

        ReadNotif::where('id', $id)
                ->update([
                    'read' => 1
                ]);

        return redirect()->back();
    }

    public function all_notification()
    {
        $notifsAll = null;

        $notifsAll = DB::table('notifications')
                    ->join('read_notifs', 'read_notifs.id_notif', '=', 'notifications.id')
                    ->where('read_notifs.id_user', Auth::user()->id)
                    ->orderBy('read_notifs.id', 'desc')
                    ->paginate(5);

        return view('main.all-notification', compact('notifsAll'));
    }

    public function unviewed_notifications()
    {
        $notifsAll = null;

        $notifsAll = DB::table('notifications')
                    ->join('read_notifs', 'read_notifs.id_notif', '=', 'notifications.id')
                    ->where([
                        'read_notifs.id_user' => Auth::user()->id,
                        'read_notifs.read'=> 0,
                    ])
                    ->orderBy('read_notifs.id', 'desc')
                    ->paginate(5);

        return view('main.unviewed-notifications', compact('notifsAll'));
    }
}
