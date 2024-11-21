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

        return view('cms.service.index',['services' => $data, 'serviceData' => $serviceData, "maxPageLimit" => $maxPageLimit, "totalservice" => $totalservice]);
    }
    public function create()
    {
        return view('cms.service.addservice');
    }
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'short_details' => 'required|string|max:500',
            'long_details' => 'required|string',
        ]);

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

        return redirect()->route('addservice')->with('success', 'service created successfully!');
    }
}
