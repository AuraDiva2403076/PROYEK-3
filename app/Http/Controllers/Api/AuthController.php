<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

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
                'otp_expires_at' => Carbon::now()->addMinutes(10),
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

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah',
            ], 401);
        }

        if ($user->email_verified_at === null) {
            return response()->json([
                'message' => 'Email belum diverifikasi. Silakan verifikasi OTP terlebih dahulu.',
            ], 403);
        }

        return response()->json([
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
}
