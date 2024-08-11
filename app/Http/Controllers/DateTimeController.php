<?php

namespace App\Http\Controllers;

use App\Models\DateTime;
use Illuminate\Http\Request;

class DateTimeController extends Controller
{
    public function index()
    {
        $dateTime = DateTime::all();
        return view('admin.department.index', compact('dateTime'));
    }

    public function create()
    {
        return view('admin.department.create');
    }

    public function store(Request $request)
    {
        // Merge the default value for status if it's not present in the request
        $request->merge(['status' => $request->input('status', '0')]);

        $request->validate([
            'time' => 'required|date_format:H:i',
            'status' => 'required|string',
        ]);

        DateTime::create($request->all());

        return redirect()->route('date-times.index')
            ->with('success', 'DateTime created successfully.');
    }

    public function show(DateTime $dateTime)
    {
        return view('date_times.show', compact('dateTime'));
    }

    public function edit(DateTime $dateTime)
    {
        return view('admin.department.edit', compact('dateTime'));
    }

    public function update(Request $request, DateTime $dateTime)
    {
        // Merge the default value for status if it's not present in the request
        $request->merge(['status' => $request->input('status', '0')]);


        $request->validate([
            'time' => 'required|date_format:H:i',
            'status' => 'required|string',
        ]);

        $dateTime->update($request->all());

        return redirect()->route('date-times.index')
            ->with('success', 'DateTime updated successfully.');
    }

    public function destroy(DateTime $dateTime)
    {
        $dateTime->delete();

        return redirect()->route('date-times.index')
            ->with('success', 'DateTime deleted successfully.');
    }
}
