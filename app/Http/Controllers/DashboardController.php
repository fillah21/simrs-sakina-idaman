<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        return view('layouts.master', compact('title'));
    }

    public function testing()
    {
        dd(getFirstUrl());
    }
}
