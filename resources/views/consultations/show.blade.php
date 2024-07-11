@extends('layout')

@section('content')
<div class="container">
    <h1>Consultation Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Consultation ID: {{ $consultation->id }}</h5>
            <p class="card-text"><strong>Patient Name:</strong> {{ $consultation->patient_name }}</p>
            <p class="card-text"><strong>Doctor Name:</strong> {{ $consultation->doctor->name }}</p>
            <p class="card-text"><strong>Symptoms:</strong> {{ $consultation->symptoms }}</p>
            <p class="card-text"><strong>Diagnosis:</strong> {{ $consultation->diagnosis }}</p>
            <p class="card-text"><strong>Prescription:</strong> {{ $consultation->prescription }}</p>
            <p class="card-text"><strong>Details:</strong> {{ $consultation->details }}</p>
        </div>
    </div>
</div>
@endsection
