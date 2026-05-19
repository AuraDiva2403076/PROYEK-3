<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FirebaseNotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function saveToken(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'fcm_token' => 'required',
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        $user->fcm_token = $request->fcm_token;
        $user->save();

        return response()->json([
            'message' => 'FCM token berhasil disimpan',
        ]);
    }

    public function testNotification(Request $request, FirebaseNotificationService $firebase)
    {
        $request->validate([
            'user_id' => 'required',
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        if (!$user->fcm_token) {
            return response()->json([
                'message' => 'FCM token kosong',
            ], 400);
        }

        $firebase->sendNotification(
            $user->fcm_token,
            'Notifikasi HARA 💖',
            'Test notifikasi dari Laravel berhasil!'
        );

        return response()->json([
            'message' => 'Notifikasi berhasil dikirim',
        ]);
    }
}   