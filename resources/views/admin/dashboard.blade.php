@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }}!</h1>

        <p class="mb-4 text-gray-700">You are logged in as a <strong>Superadmin</strong>.</p>

        <div class="flex space-x-4">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                Logout
            </a>

            <a href="{{ route('users.index') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Manage Users
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
@endsection
