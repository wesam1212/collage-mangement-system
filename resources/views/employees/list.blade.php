@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 Employees List</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($employees->count() > 0)
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Job Title</th>
                <th>Email</th>
                <th>Salary</th>
                <th>Age</th>
                <th>Gender</th>
                <th style=></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $emp)
                <tr>
                    <td>{{ $emp->name }}</td>
                    <td>{{ $emp->position ?? '-' }}</td>
                    <td>{{ $emp->email }}</td>
                    <td>{{ $emp->salary }}</td>
                    <td>{{ $emp->age ?? '-' }}</td>
                    <td>{{ $emp->gender ?? '-' }}</td>
                    <td>
                        <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-warning btn-sm">✏Edit</a>

                        <form action="{{ route('employees.delete', $emp->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑Delete</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination Links --}}
    {{ $employees->links() }}

    @else
        <div class="alert alert-info">There are no employees currently</div>
    @endif
</div>
@endsection
