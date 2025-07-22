<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'username'   => ['required', 'string', 'max:255', 'unique:users'],
            'email'      => ['required', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'confirmed', Password::defaults()],
            // Remove role from validation or make it optional
        ]);

        // Set default role to 'viewer' and override only if admin is registering someone
        $data['role'] = $request->has('role') && Auth::check() && Auth::user()->isAdmin() 
                       ? $request->role 
                       : 'viewer';

        $user = User::create($data);

        Auth::login($user);

        return redirect('/'); // Use redirect() without route() for home URL
    }
}