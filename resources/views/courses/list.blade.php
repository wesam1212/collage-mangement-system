@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-4">📋 Courses List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($courses->count() > 0)

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>

                <th>name</th>
                <th>Doctor</th>
                <th>Department</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>

                <td>{{ $course->title }}</td>
                <td>
                    @if($course->doctors->count())
                        {{ $course->doctors->pluck('name')->join(', ') }}
                    @else
                        No doctors assigned
                    @endif
                </td>
                <td>{{ optional($course->department)->name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">✏ Edit</a>
                    <form action="{{ route('courses.delete', $course->id) }}"
                          method="GET"
                          style="display:inline-block;"
                          onsubmit="return confirm('Are you sure you want to delete this course?');">
                        <button type="submit" class="btn btn-sm btn-danger">🗑Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


<footer class="text-center mt-5 py-3 bg-light border-top">
    <p class="mb-0 text-muted">&copy; {{ date('Y') }} Designed by
        <a href="https://www.linkedin.com/in/wesam-thaziz-2256b824a/" class="text-decoration-none fw-bold" target="_blank">
            Wesam Tharwat
        </a>
    </p>
</footer>
    @else
        <div class="alert alert-info">No courses found.</div>
    @endif
</div>

@endsection
