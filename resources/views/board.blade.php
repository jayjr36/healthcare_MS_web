@extends('layout')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-title text-white bg-danger  px-3 py-2 mb-0">APPOINTMENTS</p>
                        <p class="text-center py-3 text-3xl">{{ count($appointments) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-title text-white bg-danger py-2 mb-0">PATIENTS</p>
                        <p class="text-center py-3 text-3xl">{{ $doctor->doctor['patients'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
          
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-title text-white bg-danger px-3 py-2 mb-0">REVIEWS</p>
                        <p class="text-center py-3 text-3xl">{{ count($reviews) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Latest Reviews</h6>
            </div>
            <div class="card-body">
                @if (isset($reviews) && !$reviews->isEmpty())
                    <ul class="list-group">
                        @foreach ($reviews as $review)
                            @if (isset($review->reviews) && $review->reviews != '')
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $review->reviewed_by }}</h6>
                                        <div class="flex justify-between">
                                            <span class="mb-2 text-xs">{{ $review->reviews ?? '-' }}</span>
                                            <span class="mb-2 text-xs">{{ $review->created_at ?? '-' }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <div class="border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                        <h6 class="mb-3 text-sm">No Reviews Yet!</h6>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
