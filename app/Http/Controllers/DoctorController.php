<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Course;

class DoctorController extends Controller
{
    // عرض قائمة الدكاترة مع تحميل الكورسات المرتبطة بكل دكتور
    public function index()
    {
        $doctors = Doctor::with('courses')->get();
        return view('doctors.list', compact('doctors'));
    }

    // عرض صفحة إضافة دكتور جديد مع جلب الأقسام فقط (الكورسات تبدأ فارغة)
    public function create()
    {
        $departments = Department::all();
        $courses = collect(); // مجموعة فارغة

        return view('doctors.add', compact('departments', 'courses'));
    }

    // حفظ دكتور جديد مع التحقق من صحة البيانات وربط الكورسات
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'email' => 'required|email|unique:doctors,email',
            'salary' => 'nullable|numeric',
            'age' => 'nullable|integer',
            'gender' => 'required|in:Male,Female',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ]);

        $doctor = Doctor::create([
            'name' => $validated['name'],
            'department_id' => $validated['department_id'],
            'email' => $validated['email'],
            'salary' => $validated['salary'] ?? null,
            'age' => $validated['age'] ?? null,
            'gender' => $validated['gender'],
        ]);

        // ربط الدكاترة بالكورسات المختارة (إذا وجدت)
        if (!empty($validated['courses'])) {
            $doctor->courses()->sync($validated['courses']);
        }

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully!');
    }

    // عرض صفحة تعديل دكتور موجود مع جلب الأقسام والكورسات الخاصة بالقسم
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $departments = Department::all();
        // جلب الكورسات الخاصة بقسم الدكتور الحالي فقط
        $courses = Course::where('department_id', $doctor->department_id)->get();

        return view('doctors.edit', compact('doctor', 'departments', 'courses'));
    }

    // تحديث بيانات دكتور مع التحقق وربط الكورسات المحدثة
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'email' => 'required|email|unique:doctors,email,' . $id,
            'salary' => 'nullable|numeric',
            'age' => 'nullable|integer',
            'gender' => 'required|in:Male,Female',
            'courses' => 'nullable|array',
            'courses.*' => 'exists:courses,id',
        ]);

        $doctor->update([
            'name' => $validated['name'],
            'department_id' => $validated['department_id'],
            'email' => $validated['email'],
            'salary' => $validated['salary'] ?? null,
            'age' => $validated['age'] ?? null,
            'gender' => $validated['gender'],
        ]);

        // تحديث علاقة الكورسات أو إلغاء الارتباط إن لم توجد
        if (!empty($validated['courses'])) {
            $doctor->courses()->sync($validated['courses']);
        } else {
            $doctor->courses()->detach();
        }

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully!');
    }

    // حذف دكتور
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully!');
    }

    // البحث عن دكتور بالاسم (يدعم عرض نتائج البحث)
    public function search(Request $request)
    {
        $keyword = $request->input('query');

        $doctors = Doctor::where('name', 'like', "%{$keyword}%")->get();

        return view('doctors.list', compact('doctors'))->with('query', $keyword);
    }
}
