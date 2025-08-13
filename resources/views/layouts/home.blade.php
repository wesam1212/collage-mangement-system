@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 fw-bold text-center">📊 Dashboard</h2>
    <div class="row g-4">

        {{-- Card Data --}}
        @php
            $cards = [
                [
                    'title' => 'Doctors',
                    'count' => $doctorsCount,
                    'color' => 'primary',
                    'route' => 'doctors.search',
                    'listId' => 'doctorsList',
                    'items' => $doctors,
                    'field' => 'name'
                ],
                [
                    'title' => 'Students',
                    'count' => $studentsCount,
                    'color' => 'success',
                    'route' => 'students.search',
                    'listId' => 'studentsList',
                    'items' => $students,
                    'field' => 'name'
                ],
                [
                    'title' => 'Departments',
                    'count' => $departmentsCount,
                    'color' => 'warning',
                    'route' => 'departments.search',
                    'listId' => 'departmentsList',
                    'items' => $departments,
                    'field' => 'name'
                ],
                [
                    'title' => 'Courses',
                    'count' => $coursesCount,
                    'color' => 'danger',
                    'route' => 'courses.search',
                    'listId' => 'coursesList',
                    'items' => $courses,
                    'field' => 'title'
                ],
                // إضافة الموظفين هنا
                [
                    'title' => 'Employees',
                    'count' => $employeesCount ?? 0,
                    'color' => 'info',
                    'route' => 'employees.list',  // عدل حسب اسم الراوت الخاص ببحث الموظفين إذا موجود
                    'listId' => 'employeesList',
                    'items' => $employees ?? [],
                    'field' => 'name'
                ],
            ];
        @endphp

        {{-- Cards --}}
        @foreach($cards as $card)
        <div class="col-md-3">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header text-white bg-{{ $card['color'] }} text-center fw-bold">
                    {{ $card['title'] }}
                </div>
                <div class="card-body text-center">
                    <p class="display-6 fw-bold text-{{ $card['color'] }}">{{ $card['count'] }}</p>
                </div>
                <div class="card-footer bg-white border-0">
                    <form action="{{ route($card['route']) }}" method="GET" class="d-flex">
                        <input
                            autocomplete="off"
                            list="{{ $card['listId'] }}"
                            name="query"
                            class="form-control form-control-sm me-2 border rounded-pill shadow-sm"
                            placeholder="Search {{ strtolower($card['title']) }}..."
                        >
                        <datalist id="{{ $card['listId'] }}">
                            @foreach($card['items'] as $item)
                                <option value="{{ $item[$card['field']] }}">
                            @endforeach
                        </datalist>
                        <button class="btn btn-outline-{{ $card['color'] }} btn-sm rounded-pill px-3" type="submit">
                            🔍
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

<footer class="text-center mt-5 py-3 bg-light border-top shadow-sm">
    <p class="mb-0 text-muted">
        &copy; {{ date('Y') }} Designed by
        <a href="https://www.linkedin.com/in/wesam-thaziz-2256b824a/"
           class="text-decoration-none fw-bold" target="_blank">
            Wesam Tharwat
        </a>
    </p>
</footer>
@endsection
