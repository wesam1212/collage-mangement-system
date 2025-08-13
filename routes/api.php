<?php

use Illuminate\Support\Facades\Route;
use App\Models\Course;
use Illuminate\Http\Request;

Route::get('/courses', function(Request $request) {
    $departmentId = $request->query('department_id');
    if (!$departmentId) {
        return response()->json([]);
    }
    $courses = Course::where('department_id', $departmentId)->get(['id', 'title']);
    return response()->json($courses);
});
