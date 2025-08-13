<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Department;
use App\Models\Course;
use App\Models\Doctor;

class StudentController extends Controller
{
    public function index()
    {
        // استدعاء الكورسات والدكاترة المرتبطين بكل طالب
        $students = Student::with('courses.doctors')->paginate(10);
        return view('students.list', compact('students'));
    }

    public function create(Request $request)
    {
        $departments = Department::all();

        $courses = collect();
        if ($request->has('department_id') && $request->department_id != '') {
            $courses = Course::where('department_id', $request->department_id)->get();
        }

        return view('students.add', compact('departments', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'nullable|array',
            'course_id.*' => 'exists:courses,id',
            'email' => 'required|email|unique:students,email',
            'age' => 'nullable|integer',
            'gender' => 'nullable|in:Male,Female',
        ]);

        // إنشاء الطالب
        $student = Student::create([
            'name' => $validated['name'],
            'department_id' => $validated['department_id'],
            'email' => $validated['email'],
            'age' => $validated['age'] ?? null,
            'gender' => $validated['gender'] ?? null,
        ]);

        // ربط الكورسات المختارة
        if (!empty($validated['course_id'])) {
            $student->courses()->attach($validated['course_id']);
        }

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function edit($id)
    {
        $student = Student::with('courses')->findOrFail($id);
        $departments = Department::all();
$courses = collect();
if ($student->department_id) {
    $courses = Course::where('department_id', $student->department_id)->get();
}

        return view('students.edit', compact('student', 'departments', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'age' => 'nullable|integer|min:1',
            'gender' => 'nullable|in:Male,Female',
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'nullable|array',
            'course_id.*' => 'exists:courses,id',
        ]);

        // تحديث بيانات الطالب
        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'age' => $validated['age'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'department_id' => $validated['department_id'],
        ]);

        // تحديث الكورسات المرتبطة
        if (!empty($validated['course_id'])) {
            $student->courses()->sync($validated['course_id']);
        } else {
            $student->courses()->detach();
        }

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->courses()->detach();
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('query');
        $students = Student::where('name', 'like', "%{$keyword}%")->paginate(20);
        return view('students.list', compact('students'))->with('query', $keyword);
    }
}
