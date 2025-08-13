@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Employee Details</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $employee->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Position / Job Title</label>
            <input type="text" name="position" class="form-control" required value="{{ old('position', $employee->position) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', $employee->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Salary</label>
            <input type="number" name="salary" step="0.01" class="form-control" value="{{ old('salary', $employee->salary) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $employee->age) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="" disabled {{ old('gender', $employee->gender) ? '' : 'selected' }}>Select Gender</option>
                <option value="Male" @if(old('gender', $employee->gender)=='Male') selected @endif>Male</option>
                <option value="Female" @if(old('gender', $employee->gender)=='Female') selected @endif>Female</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update employee</button>
    </form>
</div>
@endsection
