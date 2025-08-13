@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Employee</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form action="{{ route('employees.store') }}" method="POST">
    @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter employee name" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Job</label>
            <input type="text" name="position" class="form-control" placeholder="Enter job title" required value="{{ old('position') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email address" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Salary</label>
            <input type="number" name="salary" step="0.01" class="form-control" placeholder="Enter salary amount" value="{{ old('salary') }}">
        </div>

       <div class="mb-3">
    <label class="form-label">Age</label>
    <input type="number" name="age" class="form-control" placeholder="Enter age" value="{{ old('age') }}" min="1" max="60">
</div>


        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                <option value="Male" @if(old('gender')=='Male') selected @endif>Male</option>
                <option value="Female" @if(old('gender')=='Female') selected @endif>Female</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Employee</button>
    </form>
</div>
@endsection
