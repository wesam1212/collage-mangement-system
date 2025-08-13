<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Department;
use App\Models\Doctor;

class CourseController extends Controller
{
    // عرض قائمة الكورسات مع الأقسام والدكاترة (لو في علاقة)
public function index()
{
$courses = Course::with('doctors')->get();
    return view('courses.list', compact('courses'));
}





    // صفحة إضافة كورس جديد مع بيانات الأقسام والدكاترة
    public function create()
    {   
        $departments = Department::all();
        $doctors = Doctor::all();
        return view('courses.add', compact('departments', 'doctors'));
    }

    // حفظ كورس جديد مع التحقق من البيانات
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'doctor_id' => 'nullable|exists:doctors,id',
        ]);

        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course added successfully!');
    }

    // صفحة تعديل كورس مع تحميل بيانات الكورس والأقسام والدكاترة
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $departments = Department::all();
        $doctors = Doctor::all();

        return view('courses.edit', compact('course', 'departments', 'doctors'));
    }

    // تحديث بيانات الكورس مع التحقق من البيانات
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'doctor_id' => 'nullable|exists:doctors,id',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    // حذف كورس
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }

    // بحث في الكورسات حسب العنوان
    public function search(Request $request)
    {
        $keyword = $request->input('query');
        $courses = Course::where('title', 'like', "%{$keyword}%")->paginate(10);

        return view('courses.list', compact('courses'))->with('query', $keyword);
    }
}
