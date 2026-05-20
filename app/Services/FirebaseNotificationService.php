<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Exception\FirebaseException;

class FirebaseNotificationService
{
    protected $messaging;

    public function __construct()
    {
        $this->messaging = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createMessaging();
    }

    public function sendNotification($token, $title, $body)
    {
        try {
            $message = CloudMessage::new()
                ->toToken($token)
                ->withData([
                    'title' => $title,
                    'body' => $body,
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                ]);

            return $this->messaging->send($message);

        } catch (MessagingException | FirebaseException $e) {
            \Log::error('FCM Error: ' . $e->getMessage());
            return false;
        }
    }
}