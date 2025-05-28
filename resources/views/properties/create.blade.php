@extends('layouts.main')

@section('title', 'Sign in')
@section('meta_description', 'Login to access your dashboard')

@section('content')
  <!-- Page -->
  <!-- Main -->
  <div class="flex grow">
   <!-- Sidebar -->
    @include('partials.sidebar')
   <!-- End of Sidebar -->
   <!-- Wrapper -->
   <div class="wrapper flex grow flex-col">
    <!-- Header -->
    @include('partials.header')
    <!-- End of Header -->
    <!-- Content -->
    <main class="grow content pt-5" id="content" role="content">
        <div class="container-fluid">
            <div class="card card-grid h-full min-w-full">
                <div class="card-body">
                    <div class="container-fixed mx-auto py-10">
                        @include('properties._form', [
                            'action' => route('properties.store'),
                            'method' => 'POST',
                            'submitLabel' => 'Create Property',
                            'property' => null
                        ])
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End of Content -->
    <!-- Footer -->
    @include('partials.footer')
    <!-- End of Footer -->
   </div>
   <!-- End of Wrapper -->
  </div>
  <!-- End of Main -->
  <!-- End of Page -->
`@endsection
