<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TopNews;
use Illuminate\Http\Request;

class TopNewsApiController extends Controller
{
    public function index()
    {
        return TopNews::where('topic','default')->orderBy('date','desc')->get();

    }

    public function custom_list($count)
    {
        return TopNews::where('topic','default')->orderBy('date', 'desc')->take($count)->get();
    }

    // public function store(Request $request)
    // {
    //     $news = TopNews::create($request->all());
    //     return response()->json($news, 201);
    // }
}
