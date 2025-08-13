<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\EmployeeController;

// 🏠 الصفحة الرئيسية
Route::get('/', function () {
    $doctorsCount = \App\Models\Doctor::count();
    $studentsCount = \App\Models\Student::count();
    $departmentsCount = \App\Models\Department::count();
    $coursesCount = \App\Models\Course::count();
    $employeesCount = \App\Models\Employee::count();

    $doctors = \App\Models\Doctor::latest()->limit(5)->get();
    $students = \App\Models\Student::latest()->limit(5)->get();
    $departments = \App\Models\Department::latest()->limit(5)->get();
    $courses = \App\Models\Course::latest()->limit(5)->get();
    $employees = \App\Models\Employee::latest()->limit(5)->get();

    return view('layouts.home', compact(
        'doctorsCount',
        'studentsCount',
        'departmentsCount',
        'coursesCount',
        'employeesCount',
        'doctors',
        'students',
        'departments',
        'courses',
        'employees'
    ));
});

// ========== API Routes ==========
// تجميع كل API routes تحت prefix واحد
Route::prefix('api')->group(function () {
    Route::get('/doctor-by-course/{courseId}', [ApiController::class, 'getDoctorByCourse'])->name('api.doctor.by_course');
    Route::get('/courses-by-department/{departmentId}', [ApiController::class, 'getCoursesByDepartment'])->name('api.courses.by_department');
});

// ========== Doctors Routes ==========
Route::prefix('doctors')->group(function () {
    Route::get('/list', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/add', [DoctorController::class, 'create'])->name('doctors.add');
    Route::post('/save', [DoctorController::class, 'store'])->name('doctors.save');
    Route::get('/edit/{id}', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('/update/{id}', [DoctorController::class, 'update'])->name('doctors.update'); // PUT وليس POST
    Route::delete('/delete/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::get('/search', [DoctorController::class, 'search'])->name('doctors.search');
});

// ========== Students Routes ==========
Route::prefix('students')->group(function () {
    Route::get('/list', [StudentController::class, 'index'])->name('students.index');
    Route::get('/add', [StudentController::class, 'create'])->name('students.add');
    Route::post('/save', [StudentController::class, 'store'])->name('students.store');
    Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
    Route::get('/delete/{id}', [StudentController::class, 'destroy'])->name('students.delete');
    Route::get('/search', [StudentController::class, 'search'])->name('students.search');
});

// ========== Departments Routes ==========
Route::prefix('departments')->group(function () {
    Route::get('/list', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/add', [DepartmentController::class, 'create'])->name('departments.add');
    Route::post('/save', [DepartmentController::class, 'store'])->name('departments.save');
    Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::post('/update/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::get('/delete/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    Route::get('/search', [DepartmentController::class, 'search'])->name('departments.search');
Route::resource('students', StudentController::class);

});

// ========== Courses Routes ==========
Route::prefix('courses')->group(function () {
    Route::get('/list', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/add', [CourseController::class, 'create'])->name('courses.add');
    Route::post('/save', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('/update/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::get('/delete/{id}', [CourseController::class, 'destroy'])->name('courses.delete');
    Route::get('/search', [CourseController::class, 'search'])->name('courses.search');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');

});

// ========== Employees Routes ==========
Route::prefix('employees')->group(function () {
    Route::get('/list', [EmployeeController::class, 'index'])->name('employees.list');
    Route::get('/add', [EmployeeController::class, 'create'])->name('employees.add');
    Route::post('/save', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('employees.update'); // PUT وليس POST
    Route::delete('/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees.delete');
});
