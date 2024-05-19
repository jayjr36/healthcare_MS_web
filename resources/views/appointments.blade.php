<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Appointments</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">My Appointments</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Patient Profile</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient_name }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->time }}</td>
                        <td><img src="{{ $appointment->patient_profile }}" alt="Patient Profile" width="50" height="50"></td>
                        <td>{{  $appointment->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
