<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Lakukan penanganan login atau registrasi dengan data user dari Google.
        // Misalnya:
        // $existingUser = User::where('email', $user->email)->first();
        // if ($existingUser) {
        //     // Lakukan proses login
        // } else {
        //     // Lakukan proses registrasi untuk user baru
        // }

        // Setelah proses login atau registrasi, arahkan pengguna ke halaman beranda atau halaman lainnya.
        return redirect()->route('home');
    }
}
