<?php

namespace App\Http\Controllers;

use App\Models\TopNews;
use App\Models\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NotificationController;

class ManualPushInsertController extends Controller
{
    public function save_push()
    {
        // Fetch all times from the date_times table
        $times = DateTime::all();

        // Pass the times to the view
        return view('admin.manual_push_insert.manual_send_notifications', compact('times'));
    }

    public function send(Request $request)
    {
        //dd($request);
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'image' => 'nullable|string',
            'data' => 'required|array',
            'data.*.key' => 'required|string',
            'data.*.value' => 'required|string',
            'date' => 'required|date_format:Y-m-d H:i:s', // Ensure date and time is in the correct format
        ]);

        $data = [];
        foreach ($request->data as $dataItem) {
            $data[$dataItem['key']] = $dataItem['value'];
        }


        $time = \Carbon\Carbon::parse($request->date)->format('H:i:s');
        DateTime::where('time', $time)->update(['status' => 1]);


        // Store data
        TopNews::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->image,
            'topic' => 'default',
            'data' => json_encode($data),
            'date' => $request->date,
        ]);


        // Flash message using the session helper
        session()->flash('status', 'News Saved successfully!');
        return redirect()->route('manual.create.notification');
    }


    public function showManualNotifications()
    {
        $notifications = TopNews::whereNull('topic')
            ->orWhere('topic', 'default')
            ->orderBy('date', 'desc')
            ->take(12) // You can also use ->limit(10)
            ->get();


        return view('admin.manual_push_insert.manual_show_notifications', compact('notifications'));
    }


    public function serveImage(Request $request)
    {
        $imageUrl = $request->query('url');

        try {
            $imageContents = @file_get_contents($imageUrl);

            if ($imageContents) {
                $mimeType = finfo_buffer(finfo_open(), $imageContents, FILEINFO_MIME_TYPE);
                return response($imageContents)->header('Content-Type', $mimeType);
            }
        } catch (\Exception $e) {
            return abort(404, 'Image not found.');
        }

        return abort(404, 'Image not found.');
    }




    public function edit($id)
    {
        // Fetch all times from the date_times table
        $times = DateTime::all();

        $notification = TopNews::findOrFail($id);
        return view('admin.manual_push_insert.manual_edit_notification', compact('notification', 'times'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'image' => 'nullable|string',
            'data' => 'required|array',
            'data.*.key' => 'required|string',
            'data.*.value' => 'required|string',
            'date' => 'required|date_format:Y-m-d H:i:s', // Ensure date and time is in the correct format
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
            'topic' => 'default',
            'data' => json_encode($data),
            'date' => $request->date,
        ]);

        session()->flash('status', 'Notification updated successfully!');

        return redirect()->route('manual.show.notification');
    }

    public function destroy($id)
    {
        $notification = TopNews::findOrFail($id);
        $notification->delete();

        session()->flash('status', 'Notification deleted successfully!');

        return redirect()->route('manual.show.notification');
    }

    public function resetList()
    {
        DateTime::where('status', '1')->update(['status' => 0]);

        session()->flash('status', 'DateTime Tabel Reset Done!');
        return redirect()->route('manual.create.notification');
    }




    public function showSingleManualPush($id)
    {
        $notification = TopNews::findOrFail($id);

        $link_trigger = $this->getKeyLinkFcm($notification->data);

        //dd($link_trigger);
        if ($link_trigger == null) {
            $link_trigger = "https://";
        }

        return view('admin.manual_push_insert.manual_single_push', compact('notification', 'link_trigger'));
    }

    public function getKeyLinkFcm($jsonData)
    {
        $dataArray = json_decode($jsonData, true);
        if (is_array($dataArray) && array_key_exists('key_link_fcm', $dataArray)) {
            return $dataArray['key_link_fcm'];
        }
        return null;
    }
}
