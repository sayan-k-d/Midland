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

        foreach ($data as $department) {
            if ($department->image) {
                // Detect MIME type dynamically
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_buffer($finfo, $department->image);
                finfo_close($finfo);

                // Encode image with the detected MIME type
                $department->image = 'data:' . $mimeType . ';base64,' . base64_encode($department->image);
            }
        }
        return view('cms.department.index', ['departments' => $data, 'departmentData' => $departmentData, "maxPageLimit" => $maxPageLimit, "totaldepartment" => $totaldepartment]);
    }
    public function create()
    {
        $editFlag = false;
        return view('cms.department.addDepartment', compact( 'editFlag'));
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
            // $imagePath = $request->file('image')->store('department_images', 'public');
            $imagePath = file_get_contents($request->file('image')->getRealPath());
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
    public function edit($id)
    {
        $department = Department::findOrFail($id); // Fetch the department or throw a 404
        $editFlag = true; // Set the flag to indicate "Edit" mode

        return view('cms.department.addDepartment', compact('department', 'editFlag'));
    }
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id); // Fetch the department

        // Validate the input
        $request->validate([
            'department_name' => 'required|string|max:255',
            'short_details' => 'required|string',
            'long_details' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update fields
        $department->department_name = $request->department_name;
        $department->short_details = $request->short_details;
        $department->long_details = $request->long_details;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($department->image_path) {
                \Storage::delete('public/' . $department->image_path);
            }

            // Store the new image
            $path = $request->file('image')->store('images', 'public');
            $department->image_path = $path;
        }

        // Save the department
        $department->save();

        return redirect()->route('departmentDetails')->with('success', 'Department updated successfully.');
    }
    public function destroy($id)
    {
        // Find the service by its ID
        $department = Department::findOrFail($id);

        // Perform soft delete
        $department->delete();

        return redirect()->route('departmentDetails')->with('success', 'Service deleted successfully.');
    }


}
