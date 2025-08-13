@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>✏ Edit Doctor</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- هذا مهم -->

        <div class="mb-3">
            <label>Doctor Name</label>
            <input type="text" name="name" value="{{ old('name', $doctor->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $doctor->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Salary</label>
            <input type="number" step="0.01" name="salary" value="{{ old('salary', $doctor->salary) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" value="{{ old('age', $doctor->age) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-select" required>
                <option value="" disabled {{ old('gender', $doctor->gender) ? '' : 'selected' }}>Select Gender</option>
                <option value="Male" {{ old('gender', $doctor->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', $doctor->gender) == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Department</label>
            <select name="department_id" class="form-select" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', $doctor->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Courses</label>
            <div>
                @foreach($courses as $course)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="courses[]" id="course{{ $course->id }}" value="{{ $course->id }}"
                            {{ in_array($course->id, old('courses', $doctor->courses->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <label class="form-check-label" for="course{{ $course->id }}">
                            {{ $course->title ?? $course->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update Doctor</button>
    </form>
</div>
@endsection
