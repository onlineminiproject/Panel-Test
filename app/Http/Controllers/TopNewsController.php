<?php
namespace App\Http\Controllers;

use App\Models\TopNews;
use Illuminate\Http\Request;

class TopNewsController extends Controller
{
    public function store(Request $request)
    {
        return redirect()->back()->with('success', 'Stored');
    }
}

