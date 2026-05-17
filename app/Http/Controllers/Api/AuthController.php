<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $otp = rand(100000, 999999);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'otp_code' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(5),
            ]);

            Mail::to($user->email)->send(new OtpMail($otp));

            return response()->json([
                'success' => true,
                'message' => 'Register berhasil. Kode OTP sudah dikirim ke email.',
                'user' => $user,
            ], 201);

        } catch (\Exception $e) {
            if (isset($user)) {
                $user->delete();
            }

            return response()->json([
                'success' => false,
                'message' => 'OTP gagal dikirim. Coba lagi nanti.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'status' => 'not_registered',
                'message' => 'Akun belum terdaftar. Silakan daftar terlebih dahulu.',
            ], 404);
        }

        if (($user->status ?? 'Aktif') === 'Diblokir') {
            return response()->json([
                'success' => false,
                'status' => 'blocked',
                'message' => 'Akun Anda telah diblokir oleh admin.',
            ], 403);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'status' => 'wrong_password',
                'message' => 'Password salah.',
            ], 401);
        }

        if ($user->email_verified_at === null) {
            return response()->json([
                'success' => false,
                'status' => 'email_not_verified',
                'message' => 'Email belum diverifikasi. Silakan verifikasi OTP terlebih dahulu.',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Login berhasil',
            'user' => $user,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        if ($user->email_verified_at !== null) {
            return response()->json([
                'message' => 'Email sudah terverifikasi',
            ]);
        }

        if ($user->otp_code !== $request->otp_code) {
            return response()->json([
                'message' => 'Kode OTP salah',
            ], 400);
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return response()->json([
                'message' => 'Kode OTP sudah expired',
            ], 400);
        }

        $user->update([
            'email_verified_at' => Carbon::now(),
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        return response()->json([
            'message' => 'Email berhasil diverifikasi',
            'user' => $user,
        ]);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        if ($user->email_verified_at !== null) {
            return response()->json([
                'message' => 'Email sudah terverifikasi',
            ], 400);
        }

        // cooldown 60 detik
        if (
            $user->otp_last_sent_at &&
            Carbon::parse($user->otp_last_sent_at)
                ->addSeconds(60)
                ->isFuture()
        ) {
            return response()->json([
                'message' => 'Tunggu 60 detik sebelum meminta OTP lagi',
            ], 429);
        }

        $otp = rand(100000, 999999);

        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
            'otp_last_sent_at' => Carbon::now(),
        ]);

        Mail::to($user->email)->send(new OtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'OTP berhasil dikirim ulang',
        ]);
    }

    public function googleLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'google_id' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && ($user->status ?? 'Aktif') === 'Diblokir') {
            return response()->json([
                'success' => false,
                'status' => 'blocked',
                'message' => 'Akun Anda telah diblokir oleh admin.',
            ], 403);
        }

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(Str::random(16)),
                'google_id' => $request->google_id,
                'email_verified_at' => now(),
            ]);
        } else {
            $user->update([
                'google_id' => $request->google_id,
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login Google berhasil',
            'user' => $user,
        ]);
    }

    public function checkUser($id)
    {
        $user = User::find($id);

        if (($user->status ?? 'Aktif') === 'Diblokir') {
            return response()->json([
                'success' => false,
                'message' => 'Akun diblokir',
            ], 403);
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }
}
