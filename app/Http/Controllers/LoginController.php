<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserForm;
use App\Models\Licence;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\NotificationRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function register_user()
    {
        $roles = Role::all();

        return view('auth.register', compact('roles'));
    }

    public function create_user(RegisterUserForm $requestForm)
    {
        User::create([
            'name' => $requestForm->input('full_name_register'),
            'email' => $requestForm->input('email_register'),
            'password' => Hash::make($requestForm->input('password_register')),
            'role_id' => $requestForm->input('role_register'),
        ]);

        return redirect()->route('login')->with('success', __('auth.registration_successfully_completed'));
    }

    public function create_user_admin(RegisterUserForm $request)
    {
        if($request->input('request-type') != "edit")
        {
            User::create([
                'name' => $request->input('full_name_register'),
                'email' => $request->input('email_register'),
                'password' => Hash::make($request->input('password_register')),
                'role_id' => $request->input('role_register'),
            ]);

            //Notification
            $url = route('app_user_management');
            $description = "auth.has_added_a_new_user";
            NotificationRepo::setNotification($description, $url);

            return redirect()->route('app_user_management')->with('success', __('dashboard.data_saved_successfully'));
        }
        else
        {
            User::where('id', $request->input('id'))
                ->update([
                    'name' => $request->input('full_name_register'),
                    'email' => $request->input('email_register'),
                    'password' => Hash::make($request->input('password_register')),
                    'role_id' => $request->input('role_register'),
                    'updated_at' => (new \DateTimeImmutable())->format('Y-m-d H:i:s'),
            ]);

            if($request->input('page') != "profile")
            {
                //Notification
                $url = route('app_user_management');
                $description = "auth.has_updated_user";
                NotificationRepo::setNotification($description, $url);

                return redirect()->route('app_user_management')->with('success', __('dashboard.data_saved_successfully'));
            }
            else
            {
                //Notification
                $url = route('app_user_management');
                $description = "auth.updated_his_profile_information";
                NotificationRepo::setNotification($description, $url);

                return redirect()->back()->with('success', __('dashboard.data_saved_successfully'));
            }
        }
    }

    public function add_user($id)
    {
        $user = User::where('id', $id)->first();

        $roles = null;

        Auth::user()->role->name === "superadmin" ? $roles = Role::all() : $roles = Role::where('name', '!=', 'superadmin')->get();

        return view('auth.add_user', compact('user', 'roles'));
    }

    public function user_management()
    {
        $users = User::get();

        return view('main.user_management', compact('users'));
    }

    public function save_permission(Request $request)
    {
        //dd($request->all());
        Permission::where('id_user', $request->input('id-user-mgmt'))->delete();

        if($request->has('mgmt-permission'))
        {
            Permission::create([
                'id_user' => $request->input('id-user-mgmt')
            ]);
        }

        //Notification
        $url = route('app_user_management');
        $description = "dashboard.has_changed_an_authorization_for_açuser";
        NotificationRepo::setNotification($description, $url);

        return redirect()->back()->with('success', __('dashboard.data_saved_successfully'));
    }

    public function delete_user(Request $request)
    {
        User::where('id', $request->input('id_element'))->delete();

        //Notification
        $url = route('app_user_management');
        $description = "auth.has_deleted_a_user";
        NotificationRepo::setNotification($description, $url);

        return redirect()->route('app_user_management')->with('success', __('dashboard.data_deleted_successfully'));
    }

    public function profile()
    {
        $licence = Licence::first();

        $expiration = Carbon::parse($licence->date_expiration);
        $now = Carbon::now();

        $jours_restant = max(0, $now->diffInDays($expiration, false));

        return view('auth.profile', compact('licence', 'jours_restant'));
    }
}
