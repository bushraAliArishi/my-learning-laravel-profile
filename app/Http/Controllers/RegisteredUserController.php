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
            'first_name' => ['required','string','max:255'],
            'last_name'  => ['required','string','max:255'],
            'username'   => ['required','string','max:255','unique:users'],
            'email'      => ['required','email','max:255','unique:users'],
            'password'   => ['required','confirmed', Password::defaults()],
        ]);

        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('/');
    }
}





