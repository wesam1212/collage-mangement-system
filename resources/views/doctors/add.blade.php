@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Add Doctor</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('doctors.save') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Doctor Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter doctor name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Salary</label>
                <input type="number" step="0.01" name="salary" class="form-control" placeholder="Enter salary" value="{{ old('salary') }}">
            </div>

               <div class="mb-3">
    <label class="form-label">Age</label>
    <input type="number" name="age" class="form-control" placeholder="Enter age" value="{{ old('age') }}" min="1" max="60">
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
                <select name="department_id" id="department-select" class="form-select" required>
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
                <div id="courses-checkboxes">
                    {{-- سيتم ملؤها ديناميكياً بالـ checkboxes --}}
                    @if(old('courses'))
                        @foreach($courses as $course)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}" id="course-{{ $course->id }}"
                                    {{ (collect(old('courses'))->contains($course->id)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="course-{{ $course->id }}">
                                    {{ $course->title ?? $course->name }}
                                </label>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success">Add Doctor</button>
        </form>
    </div>
</div>

<footer class="text-center mt-5 py-3 bg-light border-top">
    <p class="mb-0 text-muted">&copy; {{ date('Y') }} Designed by
        <a href="https://www.linkedin.com/in/wesam-thaziz-2256b824a/" class="text-decoration-none fw-bold" target="_blank">
            Wesam Tharwat
        </a>
    </p>
</footer>

{{-- إضافة سكريبت جافاسكريبت لجلب الكورسات وتوليد checkboxes --}}
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const coursesByDepartmentUrl = "{{ url('api/courses-by-department') }}";

    $(document).ready(function() {
        $('#department-select').on('change', function() {
            let departmentId = $(this).val();
            if(departmentId) {
                $.ajax({
                    url: coursesByDepartmentUrl + '/' + departmentId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#courses-checkboxes').empty();
                        if(data.length > 0){
                            $.each(data, function(key, course){
                                let isChecked = false;
                                @if(old('courses'))
                                    let oldCourses = @json(old('courses'));
                                    if(oldCourses.includes(course.id)) {
                                        isChecked = true;
                                    }
                                @endif

                                let checkboxHtml = `
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="courses[]" value="${course.id}" id="course-${course.id}" ${isChecked ? 'checked' : ''}>
                                        <label class="form-check-label" for="course-${course.id}">
                                            ${course.title || course.name}
                                        </label>
                                    </div>
                                `;
                                $('#courses-checkboxes').append(checkboxHtml);
                            });
                        } else {
                            $('#courses-checkboxes').append('<p class="text-muted">No courses found for this department</p>');
                        }
                    }
                });
            } else {
                $('#courses-checkboxes').empty();
            }
        });

        @if(old('department_id'))
            $('#department-select').trigger('change');
        @endif
    });
</script>
@endsection
@endsection
