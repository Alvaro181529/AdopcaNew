<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user_google = Socialite::driver('google')
            ->stateless()
            ->user();

        // Verificar si el usuario ya existe por su google_id
        $existingUser = User::where('google_id', $user_google->id)->first();

        if ($existingUser) {
            // El usuario ya existe, no es necesario actualizar los campos
            $user = $existingUser;
        } else {
            // El usuario no existe, crear uno nuevo con los datos de Google
            $user = User::create([
                'google_id' => $user_google->id,
                'name' => $user_google->name,
                'email' => $user_google->email,
                'picture' => $user_google->avatar,
                'password' => $user_google->email,
            ]);
        }

        Auth::login($user);

        return redirect()->to('dashboard');
    }
}
