@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Add Student</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter student name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" placeholder="Enter age" value="{{ old('age') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Department</label>
            <select id="department" name="department_id" class="form-select" required>
                <option value="" disabled selected>Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Courses</label>
            <div id="courses-container" class="border rounded p-2" >
                <small class="text-muted"></small>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Add Student</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    function resetCourses() {
        $('#courses-container').html('<small class="text-muted">No courses available</small>');
    }

    @if(old('department_id'))
        loadCourses({{ old('department_id') }}, {!! json_encode(old('course_id', [])) !!});
    @endif

    function loadCourses(departmentId, selectedCourses = []) {
        if(departmentId) {
            $('#courses-container').html('<small>Loading...</small>');
            $.getJSON('/api/courses-by-department/' + departmentId)
                .done(function(courses) {
                    if(courses.length > 0) {
                        let html = '';
                        $.each(courses, function(i, course) {
                            let checked = selectedCourses.includes(course.id) ? 'checked' : '';
                            html += `
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="course_id[]" value="${course.id}" id="course_${course.id}" ${checked}>
                                    <label class="form-check-label" for="course_${course.id}">${course.title}</label>
                                </div>
                            `;
                        });
                        $('#courses-container').html(html);
                    } else {
                        resetCourses();
                    }
                })
                .fail(function() {
                    resetCourses();
                });
        } else {
            resetCourses();
        }
    }

    $('#department').on('change', function() {
        loadCourses($(this).val());
    });
});
</script>
@endsection
