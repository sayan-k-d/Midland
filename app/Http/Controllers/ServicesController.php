<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;

class ServicesController extends Controller
{
    public function index()
    {
        $data = null;
        $serviceData = null;
        $maxPageLimit = 10;
        $totalservice = Services::count();
        if ($totalservice > $maxPageLimit) {
            $data = Services::paginame($maxPageLimit);
        } else {
            $data = Services::all();
        }

        return view('cms.services.index',['services' => $data, 'serviceData' => $serviceData, "maxPageLimit" => $maxPageLimit, "totalservice" => $totalservice]);
    }
    public function create()
    {
        $editFlag = false;
        return view('cms.services.addService',compact('editFlag'));
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
            $imagePath = $request->file('image')->store('service_images', 'public');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update fields
        $service->service_name = $request->service_name;
        $service->short_details = $request->short_details;
        $service->long_details = $request->long_details;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($service->image_path) {
                \Storage::delete('public/' . $service->image_path);
            }

            // Store the new image
            $path = $request->file('image')->store('images', 'public');
            $service->image_path = $path;
        }

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
