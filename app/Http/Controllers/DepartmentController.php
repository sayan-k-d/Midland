<?php

namespace App\Http\Controllers;

use App\Models\AppointmentDetail;
use App\Models\Department;
use App\Models\Doctor;
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
            $data = Department::paginate($maxPageLimit);
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
        return view('cms.department.addDepartment', compact('editFlag'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'short_details' => 'required|string|max:500',
            'long_details' => 'required|string',
            'is_active' => 'required|boolean',
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
            'is_active' => $request->is_active,
        ]);
        return redirect()->route('departmentDetails')->with('success', 'Department created successfully!');
    }
    public function edit($id)
    {
        $department = Department::findOrFail($id); // Fetch the department or throw a 404
        $editFlag = true; // Set the flag to indicate "Edit" mode
        if ($department->image) {
            // Detect MIME type dynamically
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $department->image);
            finfo_close($finfo);

            // Encode image with the detected MIME type
            $department->image = 'data:' . $mimeType . ';base64,' . base64_encode($department->image);
        }

        return view('cms.department.addDepartment', compact('department', 'editFlag'));
    }
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id); // Fetch the department
        // Validate the input
        $request->validate([
            'department_name' => 'required|string|max:255',
            'short_details' => 'required|string|max:500',
            'long_details' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'is_active' => 'required|boolean',
        ]);

        if (!$request->is_active && $department->is_active !== $request->is_active) {
            $doctors = Doctor::where('department', $id)->where('is_active_department', true)->get();
            $appointments = AppointmentDetail::where('department_id', $id)->whereDate('booking_date', '>=', \Carbon\Carbon::today())->get();
            $errorMessages = [];
            foreach ($doctors as $doctor) {
                if ($doctor->isHead) {
                    $errorMessages[] = 'Cannot disable this department as it has a head doctor assigned. Please assign a new head doctor to another department before proceeding.';
                    break;
                }
            }
            if ($appointments->count() > 0) {
                $errorMessages[] = 'Cannot disable this department as it has Appointments assigned.';
            }
            if (!empty($errorMessages)) {

                return redirect()->back()->withErrors([
                    'doctorIsHead' => implode(' ', $errorMessages),
                ]);
            }

            foreach ($doctors as $doctor) {
                $doctor->is_active_department = false;
                $doctor->save();
            }
        } else if ($request->is_active && $department->is_active !== $request->is_active) {
            $doctors = Doctor::where('department', $id)->where('is_active_department', false)->get();
            foreach ($doctors as $doctor) {
                $doctor->is_active_department = true;
                $doctor->save();
            }
        }
        // Update fields
        $department->department_name = $request->department_name;
        $department->short_details = $request->short_details;
        $department->long_details = $request->long_details;
        $department->is_active = $request->is_active;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Save to database as a blob or to storage
            $imagePath = file_get_contents($request->file('image')->getRealPath());
            $department->image = $imagePath;
        }

        // Save the department
        $department->save();

        return redirect()->route('departmentDetails')->with('success', 'Department updated successfully.');
    }
    public function destroy($id)
    {
        // Find the service by its ID
        $department = Department::findOrFail($id);
        $doctors = Doctor::where('department', $id)->where('is_active_department', true)->get();
        foreach ($doctors as $doctor) {
            if ($doctor->isHead) {
                return redirect()->back()->withErrors([
                    'doctorIsHead' => 'Cannot Delete this department as it has a head doctor assigned. Please assign a new head doctor to another department before proceeding.',
                ]);
            }
            $doctor->department = null;
            $doctor->is_active_department = false;
            $doctor->save();
        }
        // Perform soft delete
        $department->delete();

        return redirect()->route('departmentDetails')->with('success', 'Department deleted successfully.');
    }

}