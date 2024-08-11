<?php

namespace App\Jobs;

use App\Services\FirebaseService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationJob implements ShouldQueue
{
    //Laravel job class that is used to send notifications asynchronously using a queue.

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $title;
    protected $body;
    protected $image;
    protected $data;
    protected $topic;

    public function __construct($title, $body, $image, $data, $topic)
    {
        $this->title = $title;
        $this->body = $body;
        $this->image = $image;
        $this->data = $data;
        $this->topic = $topic;
    }

    public function handle(FirebaseService $firebaseService)
    {
        $firebaseService->sendNotificationToTopic(
            $this->title,
            $this->body,
            $this->image,
            $this->data,
            $this->topic
        );
    }
}
