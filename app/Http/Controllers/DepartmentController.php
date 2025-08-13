<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    // عرض قائمة الأقسام
    public function index()
    {
        $departments = Department::all(); // صححت اسم المتغير هنا
        return view('departments.list', compact('departments'));
    }

    // صفحة إضافة قسم جديد
    public function create()
    {
        return view('departments.add');
    }

    // حفظ قسم جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department added successfully!');
    }

    // صفحة تعديل قسم
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    // تحديث بيانات القسم
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }

    // حذف قسم
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully!');
    }

    // بحث في الأقسام
    public function search(Request $request)
    {
        $keyword = $request->input('query');

        $departments = Department::where('name', 'like', "%{$keyword}%")->get();

        return view('departments.list', compact('departments'))->with('query', $keyword);
    }
}
