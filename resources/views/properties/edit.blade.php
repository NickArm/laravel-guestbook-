@extends('layouts.main')

@section('title', 'Edit Property - Welcomy')
@section('meta_description', 'Login to access your dashboard')

@section('content')
  <!-- Page -->
  <!-- Main -->
  <div class="flex grow">
   <!-- Wrapper -->
   <div class="wrapper flex grow flex-col">
    <!-- Header -->
    @include('partials.header')
    <!-- End of Header -->
    <!-- Navbar -->
    @include('partials.navbar')
    <!-- End of Navbar -->
    <!-- Toolbar -->
    {{-- @include('partials.toolbar') --}}
    <!-- End of Toolbar -->
    <!-- Content -->
    <main class="grow" id="content" role="content">

                @livewire('property-manager', ['property' => $property])


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
