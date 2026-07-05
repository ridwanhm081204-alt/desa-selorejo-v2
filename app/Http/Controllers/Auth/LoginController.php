<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Maksimum percobaan login sebelum di-throttle.
     * Setelah 5 kali gagal, user harus menunggu 1 menit.
     */
    private const MAX_ATTEMPTS = 5;
    private const DECAY_SECONDS = 60;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Throttle: cegah brute-force attack
        $this->ensureIsNotRateLimited($request);

        $remember = $request->has('remember');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            // Reset rate limiter setelah login berhasil
            RateLimiter::clear($this->throttleKey($request));

            // Regenerate session untuk cegah session fixation attack
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role == 'operator') {
                return redirect()->intended('/operator/dashboard');
            }
        }

        // Tambahkan hit ke rate limiter setelah gagal
        RateLimiter::hit($this->throttleKey($request), self::DECAY_SECONDS);

        return redirect()->back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session & regenerate token untuk keamanan penuh
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Pastikan request tidak melampaui batas percobaan login.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), self::MAX_ATTEMPTS)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => __('Terlalu banyak percobaan login. Silakan coba lagi dalam :seconds detik.', [
                'seconds' => $seconds,
            ]),
        ]);
    }

    /**
     * Buat throttle key unik berdasarkan email + IP address.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());
    }
}
