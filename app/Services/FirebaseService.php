<?php

namespace App\Services;

use GuzzleHttp\Client;

class FirebaseService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function sendNotificationToTopic($title, $body, $imageUrl, $data, $topic)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = [
            'Authorization' => 'key=' . env('FIREBASE_SERVER_KEY'),
            'Content-Type' => 'application/json',
        ];
        $payload = [
            'notification' => [
                'title' => $title,
                'body' => $body,
                'image' => $imageUrl,
                'android' => [
                    'notification' => [
                        'channel_id' => 'Top_News',
                        'group' => 'unique_group_key_' . uniqid(),
                    ],
                ],
            ],
            'data' => $data,
            'to' => '/topics/' . $topic,
        ];

        $response = $this->client->post($url, [
            'headers' => $headers,
            'json' => $payload,
        ]);

        return json_decode($response->getBody(), true);
    }
}
