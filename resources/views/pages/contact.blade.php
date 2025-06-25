@extends('layouts.main')

@section('title', 'Contact - Welcomy')
@section('meta_description', 'Contact')

@section('content')
<div class="flex grow">
    <div class="wrapper flex grow flex-col">
        @include('partials.header')
        @include('partials.navbar')

        <main class="grow content pt-5" id="content" role="content">
            <div class="container mx-auto py-12 max-w-2xl">
                <h1 class="text-3xl font-bold mb-6 text-center text-primary">Get in Touch</h1>

                <p class="mb-6 text-gray-700 text-center">
                    If you have any questions, partnership requests, or need credentials to access the demo, feel free to reach out.
                </p>

                <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block mb-1 font-medium text-gray-800">Your Name</label>
                        <input type="text" name="name" required class="input w-full">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-800">Your Email</label>
                        <input type="email" name="email" required class="input w-full">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-800">Message</label>
                        <textarea name="message" rows="5" class="input w-full" required></textarea>
                    </div>

                    <div class="flex justify-center mt-4">
                        <button type="submit" class="btn btn-primary px-6 py-2 text-white font-semibold rounded shadow">Send Message</button>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 text-green-700 p-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </main>

        @include('partials.footer')
    </div>
</div>
@endsection
