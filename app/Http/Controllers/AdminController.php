<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function transactions()
    {
        $transactions = Transaction::all();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show_user(){
        $name = Auth::user()->name;
        return view('admin.users', ['name' => $name]);
    }
}
