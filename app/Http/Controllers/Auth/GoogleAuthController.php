<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Ambil data user dari Google setelah mereka memberikan izin
            $googleUser = Socialite::driver('google')->user();

            // Cari apakah ada user dengan email dari data Google di database
            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                // Jika user sudah ada, lakukan proses login
                Auth::login($existingUser);
                return redirect()->route('dashboard'); // Ganti dengan rute setelah login
            } else {
                // Jika user belum ada, lakukan proses registrasi untuk user baru
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => 'pasword123456',
                ]);

                // Lakukan login untuk user baru
                Auth::login($newUser);
                return redirect()->route('dashboard'); // Ganti dengan rute setelah login
            }
        } catch (\Exception $e) {
            // Tangani pengecualian di sini
            // Misalnya, tampilkan pesan error atau log pesan kesalahan
            Log::error('Google Authentication Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['msg' => 'Terjadi kesalahan saat autentikasi dengan Google']);
        }
    }

}
