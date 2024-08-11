<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\ScheduledNotification;
use App\Jobs\SendNotificationJob;
use Carbon\Carbon;

class SendScheduledNotifications extends Command
{
    protected $signature = 'notifications:send-scheduled';
    protected $description = 'Send scheduled notifications';

    public function handle()
    {
        $now = Carbon::now('Asia/Dhaka');
        // Format the Carbon instance to ensure it matches your database format
        $formattedNow = $now->format('Y-m-d H:i:s');

        // এই মিনিটের মধ্যে যে গুলা শিডিউল করা সেগুলা দিবে
        $notifications = $this->getNotificationsWithinMinutes(30);

        foreach ($notifications as $notification) {
            SendNotificationJob::dispatch(
                $notification->title,
                $notification->body,
                $notification->image,
                json_decode($notification->data, true),
                $notification->topic
            );

            $notification->update(['sent_at' => $now]);
        }

        $this->info('Scheduled notifications have been sent and marked as sent.');
    }


    // এই মিনিটের মধ্যে যে গুলা শিডিউল করা সেগুলা দিবে ; কারেন্ট টাইম থেকে
    public function getNotificationsWithinMinutes($minutes) {
        // Get the current time
        $now = Carbon::now('Asia/Dhaka');
        $formattedNow = $now->format('Y-m-d H:i:s');

        $notifications = ScheduledNotification::where('scheduled_at', '<=', $formattedNow)
                                             ->whereNull('sent_at')
                                             ->get();

        // Filter notifications based on the time difference
        $filteredNotifications = $notifications->filter(function($notification) use ($minutes, $formattedNow) {
            $scheduledAt = Carbon::parse($notification->scheduled_at);
            $differenceInMinutes = abs(Carbon::parse($formattedNow)->diffInMinutes($scheduledAt, false)); // false to get signed difference

            // Return notifications where the absolute difference is greater than or equal to the given minutes
            return $differenceInMinutes <= $minutes;
        });
        // Return the filtered list of notifications
        return $filteredNotifications;
    }
}
