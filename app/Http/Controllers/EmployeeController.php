<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.list', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email',
        'position' => 'nullable|string|max:255',
        'age' => 'nullable|integer',
        'gender' => 'nullable|string',
    ]);

    Employee::create($request->all());

    return redirect()->route('employees.list')->with('success', 'Employee added successfully!');
}

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:employees,email,$id",
            'position' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.list')->with('success', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.list')->with('success', 'Employee deleted successfully!');
    }

}


