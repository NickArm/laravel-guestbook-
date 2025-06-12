@extends('layouts.guest')

@section('title', 'Sign in')
@section('meta_description', 'Login to access your dashboard')

@section('content')
<style>
    .login-page {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        background-color: #f9fafb;
        width: 100%;
    }

    .intro-side {
        background-color: #ffffff;
        padding: 4rem 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        border-right: 1px solid #e5e7eb;
    }

    .intro-side h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #374151;
    }

    .intro-side p {
        font-size: 1rem;
        color: #6b7280;
        margin-top: 1rem;
        max-width: 420px;
    }

    .intro-image {
        margin-top: 2rem;
        max-width: 280px;
    }

    .login-side {
        background-color: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem;
    }

    @media (max-width: 1024px) {
        .login-page {
            grid-template-columns: 1fr;
        }

        .intro-side {
            display: none;
        }
    }
</style>

<div class="login-page">
    <!-- Left (Intro) -->
    <div class="intro-side">
        <img src="{{ asset('assets/media/logos/logo.jpg') }}" alt="App Logo" class="h-18 mb-24">
        <h1 class="mt-4">Welcome to Guesthouse App</h1>
        <p>A modern tool for property owners to manage digital guestbooks for apartments, villas, and more — accessible anytime, anywhere.</p>
        <img src="{{ asset('assets/media/banners/preview.png') }}" alt="App Preview" class="intro-image rounded-xl shadow-lg border">
    </div>

    <!-- Right (Login Form) -->
    <div class="login-side">
        <div class="max-w-md bg-white shadow rounded-lg p-10">

            @if (session('status'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 border border-green-300 rounded p-3">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 text-sm text-red-600 bg-red-100 border border-red-300 rounded p-3">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600 bg-red-100 border border-red-300 rounded p-3">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                @csrf
                <div class="text-center mb-2.5">
                    <h3 class="text-lg font-medium text-gray-900 mb-2.5">Sign in to your account</h3>
                    <div class="text-sm text-gray-600">
                        Need an account?
                        <a href="{{ route('register') }}" class="text-primary underline">Sign up</a>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="form-label text-gray-700">Email</label>
                    <input class="input" type="email" name="email" placeholder="email@example.com" required>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="form-label text-gray-700">Password</label>
                    <div class="input" data-toggle-password="true">
                        <input name="password" placeholder="Enter Password" type="password" required>
                        <button class="btn btn-icon" data-toggle-password-trigger="true" type="button">
                            <i class="ki-filled ki-eye text-gray-500 toggle-password-active:hidden"></i>
                            <i class="ki-filled ki-eye-slash text-gray-500 hidden toggle-password-active:block"></i>
                        </button>
                    </div>
                </div>

                <label class="checkbox-group">
                    <input class="checkbox checkbox-sm" name="remember" type="checkbox">
                    <span class="checkbox-label">Remember me</span>
                </label>

                <button type="submit" class="btn btn-primary w-full">Sign In</button>
            </form>
        </div>
    </div>
</div>
@endsection
