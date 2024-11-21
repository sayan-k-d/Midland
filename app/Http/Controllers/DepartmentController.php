<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $data = null;
        $departmentData = null;
        $maxPageLimit = 10;
        $totaldepartment = Department::count();
        if ($totaldepartment > $maxPageLimit) {
            $data = Department::paginame($maxPageLimit);
        } else {
            $data = Department::all();
        }

        return view('cms.department.index', ['departments' => $data, 'departmentData' => $departmentData, "maxPageLimit" => $maxPageLimit, "totaldepartment" => $totaldepartment]);
    }
    public function create()
    {
        return view('cms.department.addDepartment');
    }
    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'short_details' => 'required|string|max:500',
            'long_details' => 'required|string',
        ]);

        // Handle image upload

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('department_images', 'public');
            // $imagePath = file_get_contents($request->file('image')->getRealPath());
        } else {
            $imagePath = null;
        }

        // Create a new department record
        Department::create([
            'department_name' => $request->department_name,
            'image' => $imagePath,
            'short_details' => $request->short_details,
            'long_details' => $request->long_details,
        ]);
        return redirect()->route('departmentDetails')->with('success', 'Department created successfully!');
    }
}
