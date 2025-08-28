<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserForm;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
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
}
