@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 Doctors List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
              @if($doctors->count() > 0)

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th>

                <th>Email</th>
                <th>Salary</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Department</th>
                <th>Courses</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

           @foreach($doctors as $doctor)
            <tr>
                <td>{{ $doctor->name }}</td>

                </td>
                <td>{{ $doctor->email }}</td>
                <td>{{ $doctor->salary }}</td>
                <td>{{ $doctor->age }}</td>
                <td>{{ $doctor->gender }}</td><td>{{ $doctor->department->name ?? '—' }}</td>
                <td>
                    @if($doctor->courses && $doctor->courses->count() > 0)
                        <ul class="mb-0">
                            @foreach($doctor->courses as $course)
                                <ul >{{ $course->title ?? $course->name }}</ul>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-muted">No courses</span>
                    @endif
                <td>
                    <a href="{{ url('/doctors/edit/'.$doctor->id) }}" class="btn btn-warning btn-sm">✏ Edit</a>

                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('هل أنت متأكد من الحذف؟')" class="btn btn-danger btn-sm">🗑 Delete</button>
                    </form>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
</div>
<footer class="text-center mt-5 py-3 bg-light border-top">
    <p class="mb-0 text-muted">&copy; {{ date('Y') }} Designed by
        <a href="https://www.linkedin.com/in/wesam-thaziz-2256b824a/" class="text-decoration-none fw-bold" target="_blank">
            Wesam Tharwat
        </a>
    </p>

</footer>
 @else
        <div class="alert alert-info">There are no doctor currently</div>
    @endif
@endsection
