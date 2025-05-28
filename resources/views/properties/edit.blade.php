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
    <main class="grow" id="content" role="content">
        <div class="container-fluid">
            <div class="grid gap-5 lg:gap-7.5">
@include('properties._form', [
    'action' => route('properties.update', $property),
    'method' => 'PUT',
    'property' => $property,
    'submitLabel' => 'Update Property'
])

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
