@extends('layouts.guest')

@section('title', 'Register')
@section('meta_description', 'Create a new account to manage your properties')

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
        <h1 class="mt-4">Create your account</h1>
        <p>Get started with managing your guesthouse properties and offering guests a complete digital experience.</p>
        <img src="{{ asset('assets/media/banners/preview.png') }}" alt="App Preview" class="intro-image rounded-xl shadow-lg border">
    </div>

    <!-- Right (Register Form) -->
    <div class="login-side">
        <div class="max-w-md bg-white shadow rounded-lg p-10">
            {{-- Flash & Validation Errors --}}
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

            {{-- Form --}}
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
                @csrf
                <div class="text-center mb-2.5">
                    <h3 class="text-lg font-medium text-gray-900 mb-2.5">Register your account</h3>
                    <div class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-primary underline">Sign in</a>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="form-label text-gray-700">Name</label>
                    <input class="input" type="text" name="name" placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="form-label text-gray-700">Email</label>
                    <input class="input" type="email" name="email" placeholder="email@example.com" value="{{ old('email') }}" required>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="form-label text-gray-700">Password</label>
                    <input class="input" type="password" name="password" required>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="form-label text-gray-700">Confirm Password</label>
                    <input class="input" type="password" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary w-full">Create Account</button>
            </form>
        </div>
    </div>
</div>
@endsection
