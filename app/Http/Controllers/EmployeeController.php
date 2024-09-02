<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }   

    public function add(){
        return view('employee.add');
    }

public function save(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'education_qualification' => 'required|string|max:255',
        'address' => 'required|string',
        'email' => 'required|email|unique:employee,email',
        'phone' => 'required|numeric|digits_between:10,15|unique:employee,phone',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Handle file uploads
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
        $validatedData['photo'] = $photoPath;
    }

    if ($request->hasFile('resume')) {
        $resumePath = $request->file('resume')->store('resumes', 'public');
        $validatedData['resume'] = $resumePath;
    }

    // Create a new employee record in the database
    $employee = Employee::create($validatedData);

    // Return a response (e.g., redirect, JSON response, etc.)
    return redirect()->route('employee.add')->with('success', 'Employee created successfully!');
}

public function update(Request $request, $id)
{
    // Validate the incoming data
    $validated = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'education_qualification' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
    ]);

    // Find the employee by ID
    $employee = Employee::findOrFail($id);

    // Update the employee's attributes
    $employee->firstname = $validated['firstname'];
    $employee->lastname = $validated['lastname'];
    $employee->date_of_birth = $validated['date_of_birth'];
    $employee->education_qualification = $validated['education_qualification'];
    $employee->address = $validated['address'];
    $employee->email = $validated['email'];
    $employee->phone = $validated['phone'];

    // Save the updated employee details
    $employee->update();

    // Redirect back with a success message
    return response()->json(['success' => true, 'message' => 'Employee updated successfully!']);
}


public function destroy($id)
{
    // Find and delete the employee
    $employee = Employee::findOrFail($id);
    $employee->delete();

    // Return JSON response
    return response()->json(['success' => true, 'message' => 'Employee deleted successfully!']);
}



}
