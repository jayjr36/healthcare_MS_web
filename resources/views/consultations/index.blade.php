@extends('layout')

@section('content')
<div class="container">
    <h4 class="text-center">All Consultations</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Patient Name</th>
                <th scope="col">Doctor Name</th>
                {{-- <th scope="col">Symptoms</th>
                <th scope="col">Diagnosis</th>
                <th scope="col">Prescription</th> --}}

                <th scope="col">Details</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultations as $consultation)
                <tr>
                    <td>{{ $consultation->id }}</td>
                    <td>{{ $consultation->patient_name }}</td>
                    <td>{{ $consultation->doctor->name }}</td>
                    {{-- <td>{{ $consultation->symptoms }}</td>
                    <td>{{ $consultation->diagnosis }}</td>
                    <td>{{ $consultation->prescription }}</td> --}}
                    <td>{{ $consultation->details }}</td>
                    <td>
                        <a href="{{ route('consultation.show', $consultation->id) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
