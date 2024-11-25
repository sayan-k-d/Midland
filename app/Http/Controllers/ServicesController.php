<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $data = null;
        $serviceData = null;
        $maxPageLimit = 10;
        $totalservice = Services::count();
        if ($totalservice > $maxPageLimit) {
            $data = Services::paginate($maxPageLimit);
        } else {
            $data = Services::all();
        }
        foreach ($data as $service) {
            if ($service->image) {
                // Detect MIME type dynamically
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_buffer($finfo, $service->image);
                finfo_close($finfo);

                // Encode image with the detected MIME type
                $service->image = 'data:' . $mimeType . ';base64,' . base64_encode($service->image);
            }
        }

        return view('cms.services.index', ['services' => $data, 'serviceData' => $serviceData, "maxPageLimit" => $maxPageLimit, "totalservice" => $totalservice]);
    }
    public function create()
    {
        $editFlag = false;
        $service = null;
        return view('cms.services.addService', compact('service', 'editFlag'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'service_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'short_details' => 'required|string|max:500',
            'long_details' => 'required|string',
        ]);
        // dd($request->all());
        // Handle image upload
        if ($request->hasFile('image')) {
            // $imagePath = $request->file('image')->store('service_images', 'public');
            $imagePath = file_get_contents($request->file('image')->getRealPath());
        } else {
            $imagePath = null;
        }

        // Create a new service record
        Services::create([
            'service_name' => $request->service_name,
            'image' => $imagePath,
            'short_details' => $request->short_details,
            'long_details' => $request->long_details,
        ]);

        return redirect()->route('serviceDetails')->with('success', 'service created successfully!');
    }
    public function edit($id)
    {
        $service = Services::findOrFail($id); // Find service by ID or show 404
        $editFlag = true; // Flag for edit mode
        if ($service->image) {
            // Detect MIME type dynamically
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $service->image);
            finfo_close($finfo);

            // Encode image with the detected MIME type
            $service->image = 'data:' . $mimeType . ';base64,' . base64_encode($service->image);
        }

        return view('cms.services.addService', compact('service', 'editFlag'));
    }
    public function update(Request $request, $id)
    {
        $service = Services::findOrFail($id); // Find service by ID

        // Validate the input
        $request->validate([
            'service_name' => 'required|string|max:255',
            'short_details' => 'required|string',
            'long_details' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Update fields
        $service->service_name = $request->service_name;
        $service->short_details = $request->short_details;
        $service->long_details = $request->long_details;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Read the new image as binary data
            $imageBlob = file_get_contents($request->file('image')->getRealPath());
            $service->image = $imageBlob; // Replace 'image_blob' with your actual column name for the image
        }
        // if ($request->hasFile('image')) {
        //     // Delete old image if it exists
        //     if ($service->image_path) {
        //         \Storage::delete('public/' . $service->image_path);
        //     }

        //     // Store the new image
        //     $path = $request->file('image')->store('images', 'public');
        //     $service->image_path = $path;
        // }

        // Save the service
        $service->save();

        return redirect()->route('serviceDetails')->with('success', 'Service updated successfully.');
    }
    public function destroy($id)
    {
        // Find the service by its ID
        $service = Services::findOrFail($id);

        // Perform soft delete
        $service->delete();

        return redirect()->route('serviceDetails')->with('success', 'Service deleted successfully.');
    }

}
