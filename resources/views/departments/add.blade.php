@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Add Department</h2>

    <form action="{{ url('/departments/save') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter department name" required>
        </div>

        <button type="submit" class="btn btn-success">Add Department</button>
    </form>
</div><footer class="text-center mt-5 py-3 bg-light border-top">
    <p class="mb-0 text-muted">&copy; {{ date('Y') }} Designed by
        <a href="https://www.linkedin.com/in/wesam-thaziz-2256b824a/" class="text-decoration-none fw-bold" target="_blank">
            Wesam Tharwat
        </a>
    </p>
</footer>
@endsection
