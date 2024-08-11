<?php

namespace App\Http\Controllers;

use App\Models\ApiLog;
use App\Models\TopNews;
use Illuminate\Http\Request;
use App\Jobs\SendNotificationJob;
use App\Services\FirebaseService;
use App\Models\ScheduledNotification;
use App\Http\Controllers\TopNewsController;

class NotificationController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function index()
    {
        return view('admin.notifications.send_notifications');
    }

    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'image' => 'nullable|string',
            'topic' => 'required|string|exists:topics,topic_name', // Ensure the topic exists in the topics table
            'data' => 'nullable|array',
            'data.*.key' => 'nullable|string',
            'data.*.value' => 'nullable|string',
            'date' => 'required|date_format:Y-m-d H:i:s|after:now', // Ensure date and time is in the correct format
        ]);

        $data = [];
        foreach ($request->data as $dataItem) {
            $data[$dataItem['key']] = $dataItem['value'];
        }

        // $response = $this->firebaseService->sendNotificationToTopic(
        //     $request->title,
        //     $request->body,
        //     $request->image,
        //     $data,
        //     $request->topic
        // );
        // Dispatch the job
        // SendNotificationJob::dispatch(
        //     $request->title,
        //     $request->body,
        //     $request->image,
        //     $data,
        //     $request->topic
        // );

        // Check if scheduling or immediate send
        if ($request->filled('date')) {
            // Store the scheduled notification
            ScheduledNotification::create([
                'title' => $request->title,
                'body' => $request->body,
                'image' => $request->image,
                'topic' => $request->topic,
                'data' => json_encode($data),
                'scheduled_at' => $request->date,
            ]);

            session()->flash('status', 'Notification scheduled successfully!');
        } else {
            // Immediate send
            SendNotificationJob::dispatch(
                $request->title,
                $request->body,
                $request->image,
                $data,
                $request->topic
            );

            session()->flash('status', 'Notification sent successfully!');
        }


        // Store data
        TopNews::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->image,
            'topic' => $request->topic,
            'data' => json_encode($data),
            'date' => $request->date,
        ]);


        // Flash message using the session helper
        session()->flash('status', 'Notification sent successfully!');
        return redirect()->route('create.notification');
    }


    public function showNotifications()
    {
        $notifications = TopNews::all();
        return view('admin.notifications.show_notifications', compact('notifications'));
    }

    public function edit($id)
    {
        $notification = TopNews::findOrFail($id);
        return view('admin.notifications.edit_notification', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'image' => 'nullable|string',
            'topic' => 'required|string|exists:topics,topic_name',
            'data' => 'nullable|array',
            'data.*.key' => 'nullable|string',
            'data.*.value' => 'nullable|string',
            'date' => 'required|date_format:Y-m-d H:i:s|after:now', // Ensure date and time is in the correct format
        ]);

        $notification = TopNews::findOrFail($id);

        $data = [];
        if ($request->data) {
            foreach ($request->data as $dataItem) {
                $data[$dataItem['key']] = $dataItem['value'];
            }
        }

        $notification->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->image,
            'topic' => $request->topic,
            'data' => json_encode($data),
            'date' => $request->date,
        ]);

        session()->flash('status', 'Notification updated successfully!');

        return redirect()->route('notifications.show');
    }

    public function destroy($id)
    {
        $notification = TopNews::findOrFail($id);
        $notification->delete();

        session()->flash('status', 'Notification deleted successfully!');

        return redirect()->route('notifications.show');
    }





    public function ScheduledNotifications()
    {
        $notifications = TopNews::all();
        return view('admin.notifications.show_notifications', compact('notifications'));
    }



    public function show($id)
    {
        $notification = TopNews::findOrFail($id);

        $link_trigger = NotificationController::getKeyLinkFcm($notification->data);

        //dd($link_trigger);
        if($link_trigger == null){
            $link_trigger = "https://";
        }

        return view('admin.notifications.single_push', compact('notification','link_trigger'));
    }

    public function getKeyLinkFcm($jsonData)
    {
        $dataArray = json_decode($jsonData, true);
        if (is_array($dataArray) && array_key_exists('key_link_fcm', $dataArray)) {
            return $dataArray['key_link_fcm'];
        }
        return null;
    }


     // Method to display the delete form
     public function showDeleteForm()
     {
         return view('admin.delete_form.delete_form'); // Adjust the view path as necessary
     }

    public function deleteRecordsTopNews(Request $request)
    {
        $count = $request->input('delete_count');

        // Ensure count is a positive integer
        if ($count > 0) {
            // Get the IDs of the records to delete, ordered by ID in descending order
            $recordsToDelete = TopNews::orderBy('id', 'asc')->take($count)->pluck('id');

            // Delete the records
            TopNews::destroy($recordsToDelete);

            // Optionally, you can add a flash message for user feedback
            return redirect()->back()->with('success', $count . ' records deleted successfully from TopNews table.');
        }

        // If count is not valid, return an error
        return redirect()->back()->with('error', 'Invalid number of records specified.');
    }

    public function deleteRecordsApiLog(Request $request)
    {
        $count = $request->input('delete_count');

        // Ensure count is a positive integer
        if ($count > 0) {
            // Get the IDs of the records to delete, ordered by ID in descending order
            $recordsToDelete = ApiLog::orderBy('id', 'asc')->take($count)->pluck('id');

            // Delete the records
            ApiLog::destroy($recordsToDelete);

            // Optionally, you can add a flash message for user feedback
            return redirect()->back()->with('success', $count . ' records deleted successfully from ApiLog table.');
        }

        // If count is not valid, return an error
        return redirect()->back()->with('error', 'Invalid number of records specified.');
    }
}
