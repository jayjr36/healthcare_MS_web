@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">All Doctors</h1>
    <div class="table-responsive">
        <ul class="list-group">
            @foreach($doctors as $doctor)
                @if($doctor->user->email !== 'admin@gmail.com' && Auth::user()->email !== $doctor->user->email)
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
                @endif
            @endforeach
        </ul>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger btn-lg">Back to Dashboard</a>
    </div>
</div>
@endsection
