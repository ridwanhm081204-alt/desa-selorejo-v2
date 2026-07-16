<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editPassword()
    {
        return view('operator.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama'    => 'required|string',
            'password_baru'    => 'required|string|min:8|confirmed',
        ], [
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password_baru.min'       => 'Password baru minimal 8 karakter.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama yang Anda masukkan salah.'])->withInput();
        }

        $user->update(['password' => Hash::make($request->password_baru)]);

        // Audit trail: catat aksi ganti password di log aktivitas
        \App\Models\ActivityLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'Ganti Password Akun',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->route('operator.settings.password')->with('success', 'Password berhasil diubah. Silakan login kembali jika diperlukan.');
    }
}
