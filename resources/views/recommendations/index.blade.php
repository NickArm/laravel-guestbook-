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
                        Recommendations
                    </h1>
                </div>
                <div class="flex items-center gap-2.5">
                    <a href="{{ route('recommendations.create') }}" class="btn btn-primary mb-6">
                            + Add Recommendation
                    </a>
                </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($recommendations->isEmpty())
            <p>No recommendations yet.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($recommendations as $rec)
                    <div class="border rounded p-4 bg-white shadow">
                        <h2 class="text-lg font-semibold">{{ $rec->title }}</h2>
                        <p class="text-sm text-gray-600">{{ $rec->category->name }}</p>
                        @if($rec->image_url)
                            <img src="{{ $rec->image_url }}" class="w-full h-48 object-cover mt-2 mb-2" alt="">
                        @endif
                        <p>{{ $rec->description }}</p>
                        <div class="flex gap-2 mt-4">
                            @if($rec->website_url)
                                <a href="{{ $rec->website_url }}" target="_blank" class="text-blue-600 underline">Website</a>
                            @endif
                            @if($rec->directions_url)
                                <a href="{{ $rec->directions_url }}" target="_blank" class="text-blue-600 underline">Directions</a>
                            @endif
                        </div>
                        <div class="flex justify-end gap-2 mt-4">
                            <a href="{{ route('recommendations.edit', $rec) }}" class="btn btn-sm btn-light">Edit</a>
                            <form method="POST" action="{{ route('recommendations.destroy', $rec) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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
