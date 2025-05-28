<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $properties = auth()->user()->properties;

        return view('dashboard', compact('properties'));
    }
}
