<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ScheduledNotification;
use SebastianBergmann\Environment\Console;

class TestingController extends Controller
{
    public function index()
    {

        $now = Carbon::now('Asia/Dhaka');
        // Format the Carbon instance to ensure it matches your database format
        $formattedNow = $now->format('Y-m-d H:i:s');

        // $notifications = ScheduledNotification::where('scheduled_at', '<=', $formattedNow)
        //                                      ->whereNull('sent_at')
        //                                      ->get();

        $filteredNotifications = $this->getNotificationsWithinMinutes(92); // Replace 30 with the desired number of minutes


        dd($filteredNotifications);

        return null;
    }


    // এই মিনিটের মধ্যে যে গুলা শিডিউল করা সেগুলা দিবে
    public function getNotificationsWithinMinutes($minutes) {
        // Fetch all notifications
        $notifications = ScheduledNotification::all();

        // Get the current time
        $now = Carbon::now('Asia/Dhaka');
        $formattedNow = $now->format('Y-m-d H:i:s');

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
