<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Doctor;


class ApiController extends Controller
{
    public function getCoursesByDepartment($departmentId)
    {
        $courses = Course::where('department_id', $departmentId)->get(['id', 'title']);
        return response()->json($courses);
    }

    public function getDoctorByCourse($courseId)
{
    $course = Course::with('doctor')->find($courseId);

    if ($course && $course->doctor) {
        return response()->json([
            'id' => $course->doctor->id,
            'name' => $course->doctor->name,
        ]);
    }

    return response()->json(null);
}}


