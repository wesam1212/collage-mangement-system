@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-4">📋 Students List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($students->count() > 0)

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Courses</th>
                <th>Doctors</th>
                <th>Email</th>
                <th>Age</th>
                <th>Gender</th>
                <th></th> {{-- عمود الأزرار --}}
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->department->name ?? '-' }}</td>

                <td>
                    @if($student->courses->count())
                        {{ $student->courses->pluck('title')->join(', ') }}
                    @else
                        -
                    @endif
                </td>

                <td>
                    @php
                        // نجمع كل الدكاترة المرتبطين بكل الكورسات بدون تكرار
                        $doctors = $student->courses->flatMap(function($course) {
                            return $course->doctors;
                        })->unique('id');
                    @endphp

                    @if($doctors->count())
                        {{ $doctors->pluck('name')->join(', ') }}
                    @else
                        Doctor not found
                    @endif
                </td>

                <td>{{ $student->email }}</td>
                <td>{{ $student->age ?? '-' }}</td>
                <td>{{ $student->gender ?? '-' }}</td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">✏ Edit</a>

                    <form action="{{ route('students.delete', $student->id) }}" method="GET" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                        <button type="submit" class="btn btn-sm btn-danger">🗑 Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- روابط الصفحات --}}
    {{ $students->links() }}

    <footer class="text-center mt-5 py-3 bg-light border-top">
        <p class="mb-0 text-muted">&copy; {{ date('Y') }} Designed by
            <a href="https://www.linkedin.com/in/wesam-thaziz-2256b824a/" class="text-decoration-none fw-bold" target="_blank">
                Wesam Tharwat
            </a>
        </p>
    </footer>
    @else
        <div class="alert alert-info">No students found.</div>
    @endif
</div>

@endsection
