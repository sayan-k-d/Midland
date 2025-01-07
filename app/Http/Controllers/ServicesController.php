<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        try {
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
                if ($service->innerImage) {
                    // Detect MIME type dynamically
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mimeType = finfo_buffer($finfo, $service->innerImage);
                    finfo_close($finfo);

                    // Encode image with the detected MIME type
                    $service->innerImage = 'data:' . $mimeType . ';base64,' . base64_encode($service->innerImage);
                }
            }

            return view('cms.services.index', ['services' => $data, 'serviceData' => $serviceData, "maxPageLimit" => $maxPageLimit, "totalservice" => $totalservice]);
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Load Services', 'error' => $e->getMessage()]);
        }
    }
    public function create()
    {
        try {
            $editFlag = false;
            $service = null;
            return view('cms.services.addService', compact('service', 'editFlag'));
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }
    }
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $request->validate([
                'service_name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048|dimensions:width=600,height=400',
                'innerImage' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif|max:5120|dimensions:width=1920,height=1080',
                'short_details' => 'required|string|max:500',
                'long_details' => 'required|string',
                'is_active' => 'required|boolean',
            ]);
            // dd($request->all());
            // Handle image upload
            if ($request->hasFile('image')) {
                // $imagePath = $request->file('image')->store('service_images', 'public');
                $imagePath = file_get_contents($request->file('image')->getRealPath());
            } else {
                $imagePath = null;
            }
            if ($request->hasFile('innerImage')) {
                // $imagePath = $request->file('image')->store('service_images', 'public');
                $bannerImagePath = file_get_contents($request->file('innerImage')->getRealPath());
            } else {
                $bannerImagePath = null;
            }

            // Create a new service record
            Services::create([
                'service_name' => $request->service_name,
                'image' => $imagePath,
                'innerImage' => $bannerImagePath,
                'short_details' => $request->short_details,
                'long_details' => $request->long_details,
                'is_active' => $request->is_active,
            ]);

            return redirect()->route('serviceDetails')->with('success', 'service created successfully!');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Create Service', 'error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        try {
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
            if ($service->innerImage) {
                // Detect MIME type dynamically
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_buffer($finfo, $service->innerImage);
                finfo_close($finfo);

                // Encode image with the detected MIME type
                $service->innerImage = 'data:' . $mimeType . ';base64,' . base64_encode($service->innerImage);
            }

            return view('cms.services.addService', compact('service', 'editFlag'));
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $service = Services::findOrFail($id); // Find service by ID

            // Validate the input
            $request->validate([
                'service_name' => 'required|string|max:255',
                'short_details' => 'required|string|max:500',
                'long_details' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048|dimensions:width=600,height=400',
                'innerImage' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif|max:5120|dimensions:width=1920,height=1080',
                'is_active' => 'required|boolean',
            ]);

            // Update fields
            $service->service_name = $request->service_name;
            $service->short_details = $request->short_details;
            $service->long_details = $request->long_details;
            $service->is_active = $request->is_active;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Read the new image as binary data
                $imageBlob = file_get_contents($request->file('image')->getRealPath());
                $service->image = $imageBlob; // Replace 'image_blob' with your actual column name for the image
            }
            if ($request->hasFile('innerImage')) {
                // Read the new image as binary data
                $imageBlob = file_get_contents($request->file('innerImage')->getRealPath());
                $service->innerImage = $imageBlob; // Replace 'image_blob' with your actual column name for the image
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
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Update Service', 'error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            // Find the service by its ID
            $service = Services::findOrFail($id);

            // Perform soft delete
            $service->delete();

            return redirect()->route('serviceDetails')->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Delete Service', 'error' => $e->getMessage()]);
        }
    }

}
