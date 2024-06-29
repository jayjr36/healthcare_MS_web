<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Doctors</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Category</th>
                    <th>Experience</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->email }}</td>
                        <td>{{ $doctor->doctor->category ?? 'N/A' }}</td>
                        <td>{{ $doctor->doctor->experience ?? 'N/A' }}</td>
                        <td>{{ $doctor->doctor->status ?? 'N/A' }}</td>
                        <td>
                           
                            <form action="{{ route('doctors.update-status', $doctor->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="text" name="status" class="form-control form-control-sm d-inline w-auto" placeholder="Status">
                                <button type="submit" class="btn btn-sm btn-primary">Update Status</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
