@extends('layouts.main')

@section('title', 'Sign in')
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
    <main class="grow content pt-5" id="content" role="content">
     <!-- Container -->
     <div class="container-fixed" id="content_container">
     </div>
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
       <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">
         Dashboard
        </h1>
       </div>
       <div class="flex items-center gap-2.5">
        <a class="btn btn-sm btn-light" href="#">
         Import CSV
        </a>
        <a class="btn btn-sm btn-primary" href="{{ route('properties.create') }}">
         Add Property
        </a>
       </div>
      </div>
     </div>
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      <div class="grid gap-5 lg:gap-7.5">
       <div class="card card-grid min-w-full">
        {{-- <div class="card-header flex-wrap gap-2">
         <h3 class="card-title font-medium text-sm">
          Showing 20 of 68 users
         </h3>
         <div class="flex flex-wrap gap-2 lg:gap-5">
          <div class="flex">
           <label class="input input-sm">
            <i class="ki-filled ki-magnifier">
            </i>
            <input data-datatable-search="#team_crew_table" placeholder="Search users" type="text" value="">
            </input>
           </label>
          </div>
          <div class="flex flex-wrap gap-2.5">
           <select class="select select-sm w-28">
            <option value="1">
             Active
            </option>
            <option value="2">
             Disabled
            </option>
            <option value="2">
             Pending
            </option>
           </select>
           <select class="select select-sm w-28">
            <option value="1">
             Latest
            </option>
            <option value="2">
             Older
            </option>
            <option value="3">
             Oldest
            </option>
           </select>
           <button class="btn btn-sm btn-outline btn-primary">
            <i class="ki-filled ki-setting-4">
            </i>
            Filters
           </button>
          </div>
         </div>
        </div> --}}
        <div class="card-body">
         <div data-datatable="true" data-datatable-state-save="false" id="team_crew_table">
          <div class="scrollable-x-auto">
<table class="table table-auto table-border" data-datatable-table="true">
    <thead>
        <tr>
            <th class="min-w-[200px]">
                <span class="sort asc">
                    <span class="sort-label font-normal text-gray-700">Property Name</span>
                </span>
            </th>
            <th class="min-w-[200px]">
                <span class="sort">
                    <span class="sort-label font-normal text-gray-700">Slug</span>
                </span>
            </th>
            <th class="min-w-[150px]">
                <span class="sort">
                    <span class="sort-label font-normal text-gray-700">Check-in</span>
                </span>
            </th>
            <th class="min-w-[150px]">
                <span class="sort">
                    <span class="sort-label font-normal text-gray-700">Check-out</span>
                </span>
            </th>
            <th class="w-[100px] text-center">
                <span class="sort-label font-normal text-gray-700">Actions</span>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($properties as $property)
            <tr>
                <td class="text-gray-800 font-medium">{{ $property->name }}</td>
                <td class="text-gray-800">{{ $property->slug }}</td>
                <td class="text-gray-800">{{ $property->checkin }}</td>
                <td class="text-gray-800">{{ $property->checkout }}</td>
                <td class="text-center">
                    <div class="menu flex-inline" data-menu="true">
                        <div class="menu-item" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                            <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                                <i class="ki-filled ki-dots-vertical"></i>
                            </button>
                            <div class="menu-dropdown menu-default max-w-[150px]" data-menu-dismiss="true">
                                <div class="menu-item">
                                    <a class="menu-link" href="{{ route('properties.edit', $property) }}">
                                        <span class="menu-icon"><i class="ki-filled ki-pencil"></i></span>
                                        <span class="menu-title">Edit</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="{{ route('properties.edit', $property) }}">
                                        <span class="menu-icon"><i class="ki-filled ki-eye"></i></span>
                                        <span class="menu-title">View</span>
                                    </a>
                                </div>
                                <div class="menu-separator"></div>
                                <div class="menu-item">
                                    <form method="POST" action="{{ route('properties.destroy', $property) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="menu-link w-full text-left">
                                            <span class="menu-icon"><i class="ki-filled ki-trash"></i></span>
                                            <span class="menu-title">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

          </div>
          <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
           <div class="flex items-center gap-2 order-2 md:order-1">
            Show
            <select class="select select-sm w-16" data-datatable-size="true" name="perpage">
            </select>
            per page
           </div>
           <div class="flex items-center gap-4 order-1 md:order-2">
            <span data-datatable-info="true">
            </span>
            <div class="pagination" data-datatable-pagination="true">
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>

       <div class="grid lg:grid-cols-2 gap-5 lg:gap-7.5">
        <div class="card">
         <div class="card-body px-10 py-7.5 lg:pr-12.5">
          <div class="flex flex-wrap md:flex-nowrap items-center gap-6 md:gap-10">
           <div class="flex flex-col items-start gap-3">
            <h2 class="text-1.5xl font-medium text-gray-900">
             Questions ?
            </h2>
            <p class="text-sm text-gray-800 leading-5.5 mb-2.5">
             Visit our Help Center for detailed assistance on billing, payments, and subscriptions.
            </p>
           </div>
           <img alt="image" class="dark:hidden max-h-[150px]" src="assets/media/illustrations/29.svg"/>
           <img alt="image" class="light:hidden max-h-[150px]" src="assets/media/illustrations/29-dark.svg"/>
          </div>
         </div>
         <div class="card-footer justify-center">
          <a class="btn btn-link" href="">
           Go to Help Center
          </a>
         </div>
        </div>
        <div class="card">
         <div class="card-body px-10 py-7.5 lg:pr-12.5">
          <div class="flex flex-wrap md:flex-nowrap items-center gap-6 md:gap-10">
           <div class="flex flex-col items-start gap-3">
            <h2 class="text-1.5xl font-medium text-gray-900">
             Contact Support
            </h2>
            <p class="text-sm text-gray-800 leading-5.5 mb-2.5">
             Need assistance? Contact our support team for prompt, personalized help your queries & concerns.
            </p>
           </div>
           <img alt="image" class="dark:hidden max-h-[150px]" src="assets/media/illustrations/31.svg"/>
           <img alt="image" class="light:hidden max-h-[150px]" src="assets/media/illustrations/31-dark.svg"/>
          </div>
         </div>
         <div class="card-footer justify-center">
          <a class="btn btn-link" href="https://devs.keenthemes.com/unresolved">
           Contact Support
          </a>
         </div>
        </div>
       </div>
      </div>
     </div>
     <!-- End of Container -->
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
