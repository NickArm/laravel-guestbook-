@extends('layouts.main')

@section('title', 'Dashboard - Welcomy')
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

    <main class="grow content pt-5" id="content" role="content">
     <div class="container-fixed" id="content_container">


        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-gray-900">
                            <h1 class="text-xl font-bold mb-6">Edit Recommendation</h1>
                    </h1>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('recommendations.create') }}" class="btn btn-primary mb-6">
                            + Add Recommendation
                    </a>
                </div>
        </div>
<div class="container mx-auto py-8 max-w-xl">


    <form method="POST" action="{{ route('recommendations.update', [$recommendation]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('recommendations.form', ['submit' => 'Update'])
    </form>
</div>

    </main>
    <!-- Footer -->
    @include('partials.footer')
    <!-- End of Footer -->
   </div>
   <!-- End of Wrapper -->
  </div>
  <!-- End of Main -->
  <!-- End of Page -->
@endsection

