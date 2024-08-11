<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return view('admin.topics.index', compact('topics'));
    }

    public function create()
    {
        return view('admin.topics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic_name' => 'required|string|max:255',
            'topic_desc' => 'nullable|string',
        ]);

        Topic::create($request->all());

        return redirect()->route('topics.index')->with('status', 'Topic created successfully!');
    }

    public function edit(Topic $topic)
    {
        return view('admin.topics.edit', compact('topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'topic_name' => 'required|string|max:255',
            'topic_desc' => 'nullable|string',
        ]);

        $topic->update($request->all());

        return redirect()->route('topics.index')->with('status', 'Topic updated successfully!');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('topics.index')->with('status', 'Topic deleted successfully!');
    }
}
