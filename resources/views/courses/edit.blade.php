@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">✏ Edit Course</h2>

    <form action="{{ url('/courses/update/'.$course->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
        </div>

        
        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-control" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $department->id == $course->department_id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Course</button>
    </form>
</div><footer class="text-center mt-5 py-3 bg-light border-top">
    <p class="mb-0 text-muted">&copy; {{ date('Y') }} Designed by
        <a href="https://www.linkedin.com/in/wesam-thaziz-2256b824a/" class="text-decoration-none fw-bold" target="_blank">
            Wesam Tharwat
        </a>
    </p>
</footer>
@endsection
