@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">All Doctors</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <ul class="list-group mb-4">
        @foreach($doctors as $doctor)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">{{ $doctor->user->name }}</h5>
                    <small>{{ $doctor->user->email }}</small>
                    <p class="mb-1">{{ $doctor->category }}</p>
                </div>
                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this doctor?')">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <div class="d-flex justify-content-center">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger btn-lg">Back to Dashboard</a>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .list-group-item {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    .btn-close {
        background-color: transparent;
        border: none;
    }
</style>
@endsection
