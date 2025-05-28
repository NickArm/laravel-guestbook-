@extends('layouts.guest')

@section('title', 'Sign in')
@section('meta_description', 'Login to access your dashboard')

@section('content')
<style>
    .page-bg {
        background-image: url('{{ asset('assets/media/images/2600x1200/bg-10.png') }}');
    }
    .dark .page-bg {
        background-image: url('{{ asset('assets/media/images/2600x1200/bg-10-dark.png') }}');
    }
</style>

<div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
    <div class="card max-w-[370px] w-full">
        <form method="POST" action="{{ route('login') }}" class="card-body flex flex-col gap-5 p-10">
            @csrf
            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-gray-900 leading-none mb-2.5">Sign in</h3>
                <div class="flex items-center justify-center font-medium">
                    <span class="text-2sm text-gray-700 me-1.5">Need an account?</span>
                    <a class="text-2sm link" href="#">Sign up</a>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2.5">
                <a class="btn btn-light btn-sm justify-center" href="#"><img alt="" class="size-3.5 shrink-0" src="{{ asset('assets/media/brand-logos/google.svg') }}"> Use Google</a>
                <a class="btn btn-light btn-sm justify-center" href="#">
                    <img alt="" class="size-3.5 shrink-0 dark:hidden" src="{{ asset('assets/media/brand-logos/apple-black.svg') }}">
                    <img alt="" class="size-3.5 shrink-0 light:hidden" src="{{ asset('assets/media/brand-logos/apple-white.svg') }}">
                    Use Apple
                </a>
            </div>

            <div class="flex items-center gap-2">
                <span class="border-t border-gray-200 w-full"></span>
                <span class="text-2xs text-gray-500 font-medium uppercase">Or</span>
                <span class="border-t border-gray-200 w-full"></span>
            </div>

            <div class="flex flex-col gap-1">
                <label class="form-label font-normal text-gray-900">Email</label>
                <input class="input" type="email" name="email" placeholder="email@email.com" required>
            </div>

            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between gap-1">
                    <label class="form-label font-normal text-gray-900">Password</label>
                    <a class="text-2sm link shrink-0" href="#">Forgot Password?</a>
                </div>
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

            <button type="submit" class="btn btn-primary flex justify-center grow">Sign In</button>
        </form>
    </div>
</div>
@endsection
