<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $data = null;
        $maxPageLimit = 10;
        $totalDoctors = Doctor::count();
        if ($totalDoctors > $maxPageLimit) {
            $data = Doctor::paginate($maxPageLimit);
        } else {
            $data = Doctor::all();
        }
        foreach ($data as $doctor) {
            if ($doctor->image) {
                // Detect MIME type dynamically
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_buffer($finfo, $doctor->image);
                finfo_close($finfo);

                // Encode image with the detected MIME type
                $doctor->image = 'data:' . $mimeType . ';base64,' . base64_encode($doctor->image);
            }
        }
        $departments = Department::all();
        return view("cms.doctors.index", ['doctors' => $data, 'departments' => $departments, "maxPageLimit" => $maxPageLimit, "totalDoctors" => $totalDoctors]);
    }
    public function create()
    {
        $editFlag = false;
        $doctor = null;
        $departments = Department::all();
        $existingHead = Doctor::where('isHead', 1)->exists();
        return view('cms.doctors.addDoctor', compact('doctor', 'editFlag', "departments", "existingHead"));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'doctor_name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|email|unique:doctors,email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'doctor_post' => 'required|string|max:255',
            'department' => 'required|integer',
            'biography' => 'required|string',
            'education' => 'required|string',
            'experience' => 'required|numeric',
            'languages' => 'required|string',
            'address' => 'required|string',
            'workingDays' => 'required|array',
            'workingDays.*' => 'required|string',
            'workingHours' => 'required|array',
            'workingHours.*' => 'required|string',
            'degree' => 'required|string',
            'isHead' => 'nullable|in:checked',
        ]);

        // Handle the image upload if there is one
        if ($request->hasFile('image')) {
            $imagePath = file_get_contents($request->file('image')->getRealPath());
        } else {
            $imagePath = null;
        }

        // Prepare working schedules
        $workingSchedules = [];
        for ($i = 0; $i < count($request->workingDays); $i++) {
            $workingSchedules[] = $request->workingDays[$i] . '=' . $request->workingHours[$i];
        }
        $implodedSchedules = implode(", ", $workingSchedules);
        // If the doctor being created is marked as the head, update the previous head's status
        $totalDoctors = Doctor::count();
        $existingHead = Doctor::where('isHead', 1)->first();
        if ($totalDoctors === 0 || !$existingHead) {
            $isHead = 1; // Automatically set as head if no doctors exist
        } else {
            if ($request->has('isHead') && $request->isHead == 'checked') {
                // Find the existing doctor with isHead = 1 and update the field to 0
                $existingHead->isHead = 0;
                $existingHead->save(); // Save the changes to the previous head
                $isHead = 1;
            } else {
                $isHead = 0; // Not a head if not explicitly marked
            }
        }

        // Create and save the new doctor
        $doctor = new Doctor();
        $doctor->doctor_name = $request->doctor_name;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->image = $imagePath;
        $doctor->doctor_post = $request->doctor_post;
        $doctor->department = $request->department;
        $doctor->biography = $request->biography;
        $doctor->education = $request->education;
        $doctor->experience = $request->experience;
        $doctor->languages = $request->languages;
        $doctor->address = $request->address;
        $doctor->degree = $request->degree;
        $doctor->workingSchedules = $implodedSchedules;
        $doctor->isHead = $isHead;

        // Save the doctor
        $doctor->save();

        return redirect('doctorDetails')->with('success', 'Doctor created successfully.');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $editFlag = true; // Flag for edit mode
        $existingHead = Doctor::where('isHead', 1)->where('id', '!=', $id)->exists();
        if ($doctor->image) {
            // Detect MIME type dynamically
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $doctor->image);
            finfo_close($finfo);

            // Encode image with the detected MIME type
            $doctor->image = 'data:' . $mimeType . ';base64,' . base64_encode($doctor->image);
        }
        $workingSchedules = explode(',', $doctor->workingSchedules);
        $schedules = [];
        foreach ($workingSchedules as $schedule) {
            $schedule = explode('=', $schedule);
            $schedules[] = $schedule;
        }
        // $workingDays = array_map('trim', explode('=', $workingSchedules[0]));
        // $workingHours = array_map('trim', explode('=', $workingSchedules[1]));
        $departments = Department::all();
        return view('cms.doctors.addDoctor', compact('doctor', 'schedules', 'departments', 'editFlag', 'existingHead'));
    }
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        // Validate the input
        $request->validate([
            'doctor_name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'doctor_post' => 'required|string',
            'department' => 'required|integer',
            'biography' => 'required|string',
            'education' => 'required|string',
            'experience' => 'required|numeric',
            'languages' => 'required|string',
            'address' => 'required|string',
            'workingDays' => 'required|array',
            'workingDays.*' => 'required|string',
            'workingHours' => 'required|array',
            'workingHours.*' => 'required|string',
            'degree' => 'required|string',
            'isHead' => 'nullable|in:checked',
        ]);

        // Update fields
        $workingSchedules = [];
        for ($i = 0; $i < count($request->workingDays); $i++) {
            $workingSchedules[] = $request->workingDays[$i] . '=' . $request->workingHours[$i];
        }

        $implodedSchedules = implode(", ", $workingSchedules);
        $doctor->doctor_name = $request->doctor_name;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->doctor_post = $request->doctor_post;
        $doctor->department = $request->department;
        $doctor->biography = $request->biography;
        $doctor->education = $request->education;
        $doctor->experience = $request->experience;
        $doctor->languages = $request->languages;
        $doctor->address = $request->address;
        $doctor->degree = $request->degree;
        $doctor->workingSchedules = $implodedSchedules;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Read the new image as binary data
            $imageBlob = file_get_contents($request->file('image')->getRealPath());
            $doctor->image = $imageBlob; // Replace 'image_blob' with your actual column name for the image
        }

        // If this doctor is being set as the head, update the previous head doctor to not be the head
        if ($request->has('isHead') && $request->isHead == 'checked') {
            // Find and update the existing head doctor to not be the head
            $existingHead = Doctor::where('isHead', 1)->first();
            if ($existingHead && $existingHead->id !== $doctor->id) {
                // Update the existing head's isHead field to 0
                $existingHead->isHead = 0;
                $existingHead->save();
            }

            // Set this doctor as the head
            $doctor->isHead = 1;
        } else {
            // If the doctor is not being set as the head, make sure their isHead is 0
            $otherHeadExists = Doctor::where('isHead', 1)->where('id', '!=', $doctor->id)->exists();

            if (!$otherHeadExists) {
                // Validation error if no other doctor is marked as head
                return redirect()->back()->withErrors([
                    'isHead' => 'At least one doctor must be marked as the head.',
                ]);
            }
            $doctor->isHead = 0;
        }

        // Save the doctor
        $doctor->save();

        return redirect()->route('doctorDetails')->with('success', 'Doctor updated successfully.');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctorDetails')->with('success', 'Doctor deleted successfully.');
    }

}
