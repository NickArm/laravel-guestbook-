<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $properties = $user->properties;

        return view('dashboard', [
            'properties' => $user->properties,
            'propertyLimit' => $user->property_limit,
            'currentCount' => $user->properties()->count(),
        ]);
    }
}
