<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Wajib di-import untuk membuat user baru
use Illuminate\Support\Facades\Auth; // Wajib di-import untuk sistem login
use Laravel\Socialite\Facades\Socialite; // Wajib di-import agar Socialite berfungsi
use Exception;

class SocialiteController extends Controller
{
    // 1. Mengarahkan user ke halaman login Google/Facebook
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // 2. Memproses data setelah user berhasil login di Google/Facebook
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Cari apakah user dengan social_id ini sudah terdaftar
            $user = User::where('social_id', $socialUser->getId())
                        ->where('social_type', $provider)
                        ->first();
                        
            if (!$user) {
                // Jika belum ada, buat user baru otomatis
                // Email otomatis langsung dianggap terverifikasi karena dari Google/FB
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'social_id' => $socialUser->getId(),
                    'social_type' => $provider,
                    'avatar' => $socialUser->getAvatar(),
                    'email_verified_at' => now(), 
                ]);
            }

            // Login-kan user ke dalam sistem Laravel
            Auth::login($user);

            // Alihkan ke halaman dashboard website QuasarTopUp Anda
            return redirect()->intended('/dashboard');

        } catch (Exception $e) {
            // Jika ada error, kembalikan ke halaman login utama
            return redirect('/login')->with('error', 'Gagal login menggunakan ' . ucfirst($provider));
        }
    }
}
