@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-2xl font-bold mb-6">Create New User</h1>

    @includeWhen(session('success'), 'partials.alert-success', ['message' => session('success')])
    @includeWhen($errors->any(), 'partials.alert-errors', ['errors' => $errors])

    @include('admin.users._form', [
        'action' => route('admin.users.store'),
        'method' => 'POST',
        'button' => 'Create User',
        'user' => new \App\Models\User,
    ])
</div>
@endsection
