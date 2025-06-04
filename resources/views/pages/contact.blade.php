@extends('layouts.app')
@section('title', 'FAQs - Welcomy')

@section('content')
<div class="container mx-auto py-12 max-w-xl">
    <h1 class="text-3xl font-bold mb-6">Get in Touch</h1>

    <p class="mb-6 text-gray-700">
        If you have any questions, partnership requests, or need credentials to access the demo, feel free to reach out.
    </p>

    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Demo Credentials</h2>
        <ul class="text-gray-700 list-disc list-inside">
            <li>Email: <code>demo@welcomy.net</code></li>
            <li>Password: <code>password</code></li>
        </ul>
    </div>

    <form method="POST" action="{{ route('contact.send') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-medium">Your Name</label>
            <input type="text" name="name" required class="input w-full">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Your Email</label>
            <input type="email" name="email" required class="input w-full">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Message</label>
            <textarea name="message" rows="5" class="input w-full" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </form>
</div>
@endsection
