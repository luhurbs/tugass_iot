<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class WhatsappNotificationService
{
    public static function getConfig()
    {
        return config('wasender');
    }

    public static function getToken()
    {
        return self::getConfig()['token'];
    }

    public static function getEndpoint()
    {
        return self::getConfig()['endpoint'];
    }

    public static function sendMessage($target, $message)
    {
        $endPoint = self::getEndpoint() . '/send';

        $headers = [
            'Authorization' => self::getToken()
        ];

        $options = [
            [
                'name' => 'target',
                'contents' => $target
            ],
            [
                'name' => 'message',
                'contents' => self::formatMessage($message)
            ]
        ];

        $response = Http::withHeaders($headers)
            ->asMultipart()
            ->post($endPoint, $options);

        return $response->body();
    }

    public static function formatMessage($message)
    {
        $message .= PHP_EOL;
        $message .= PHP_EOL;
        $message .= 'Dikirimkan pada tanggal ' . date('Y-m-d H:i:s') . ' oleh Stela';
        return $message;
    }
}

// mengambil token dari config/wasender.php
// mengirimkan pesan ke nomor whatsapp
// notifikasi kebocoran gas
