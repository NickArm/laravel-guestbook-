@extends('layouts.main')

@section('title', 'Profile')
@section('meta_description', 'Manage your profile and account settings.')

@section('content')
<!-- Main -->
<div class="flex grow">
    <!-- Wrapper -->
    <div class="wrapper flex grow flex-col">
        <!-- Header -->
        @include('partials.header')
        <!-- Navbar -->
        @include('partials.navbar')
        <!-- Content -->
        <main class="grow content pt-5" id="content" role="content">
            <div class="container-fixed">
                <div class="grid gap-5 lg:gap-7.5 xl:w-[38.75rem] mx-auto">
                    <!-- General Settings -->
                    <div class="card pb-2.5">
                        <div class="card-header" id="basic_settings">
                            <h3 class="card-title">General Settings</h3>
                        </div>
                        <div class="card-body grid gap-5">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="card pb-2.5">
                        <div class="card-header" id="password_settings">
                            <h3 class="card-title">Password</h3>
                        </div>
                        <div class="card-body grid gap-5">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="card">
                        <div class="card-header" id="delete_account">
                            <h3 class="card-title">Delete Account</h3>
                        </div>
                        <div class="card-body flex flex-col lg:py-7.5 lg:gap-7.5 gap-3">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- End of Content -->
        @include('partials.footer')
    </div>
</div>
@endsection
