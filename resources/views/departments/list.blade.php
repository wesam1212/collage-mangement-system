@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 Departments List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
              @if($departments->count() > 0)

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Department Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{ url('/departments/edit/'.$department->id) }}" class="btn btn-warning btn-sm">✏ Edit</a>
                        <a href="{{ url('/departments/delete/'.$department->id) }}"
                           onclick="return confirm('Are you sure you want to delete this department?')"
                           class="btn btn-danger btn-sm">🗑 Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div><footer class="text-center mt-5 py-3 bg-light border-top">
    <p class="mb-0 text-muted">&copy; {{ date('Y') }} Designed by
        <a href="https://www.linkedin.com/in/wesam-thaziz-2256b824a/" class="text-decoration-none fw-bold" target="_blank">
            Wesam Tharwat
        </a>
    </p>
</footer>
 @else
        <div class="alert alert-info">There are no departments</div>
    @endif
@endsection
