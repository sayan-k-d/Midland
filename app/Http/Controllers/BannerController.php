<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {

        try {
            //code...
            $data = null;
            $bannerData = null;
            $maxPageLimit = 10;
            $totalbanner = Banner::count();
            if ($totalbanner > $maxPageLimit) {
                $data = Banner::paginate($maxPageLimit);
            } else {
                $data = Banner::all();
            }

            foreach ($data as $banner) {
                if ($banner->image) {
                    // Detect MIME type dynamically
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mimeType = finfo_buffer($finfo, $banner->image);
                    finfo_close($finfo);

                    // Encode image with the detected MIME type
                    $banner->image = 'data:' . $mimeType . ';base64,' . base64_encode($banner->image);
                }
            }
            return view('cms.banners.index', ['banners' => $data, 'bannerData' => $bannerData, "maxPageLimit" => $maxPageLimit, "totalbanner" => $totalbanner]);
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Load Banners', 'error' => $e->getMessage()]);
        }
    }
    public function create()
    {
        try {
            //code...
            $editFlag = false;
            $pages = ['Home', "About", "Departments", "Services", "Doctors", "Blogs", "Contact", "Appointment"];
            return view('cms.banners.addBanner', compact('editFlag', 'pages'));
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }
    }

    /**
     * Store a new banner in the database.
     */
    public function store(Request $request)
    {
        // Validate the request
        // dd($request->all());
        try {
            $request->validate([
                'page' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif',
                'banner_title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'page_url' => 'nullable|string',
                'button_label' => 'nullable|string',
                'type' => 'required|in:carousel,single',
                'position' => 'nullable|integer',
                'is_active' => 'required|boolean',
            ]);

            // dd($request->all());

            // Handle banner_image upload
            if ($request->hasFile('image')) {
                $imagePath = file_get_contents($request->file('image')->getRealPath());
                // dd($imagePath);
            } else {
                $imagePath = null;

            }
            // dd($imagePath);
            // Insert into the database
            Banner::create([
                'page' => $request->input('page'),
                'image' => $imagePath,
                'banner_title' => $request->input('banner_title'),
                'description' => $request->input('description'),
                'page_url' => $request->input('page_url'),
                'button_label' => $request->input('button_label'),
                'type' => $request->input('type'),
                'position' => $request->input('position'),
                'is_active' => $request->input('is_active'),
            ]);

            return redirect('bannerDetails')->with('success', 'Banner added successfully.');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Add Banner', 'error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $editFlag = true; // Set the flag to indicate "Edit" mode
            if ($banner->image) {
                // Detect MIME type dynamically
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_buffer($finfo, $banner->image);
                finfo_close($finfo);

                // Encode image with the detected MIME type
                $banner->image = 'data:' . $mimeType . ';base64,' . base64_encode($banner->image);
            }
            $pages = ['Home', "About", "Departments", "Services", "Doctors", "Blogs", "Contact", "Appointment"];
            return view('cms.banners.addBanner', compact('banner', 'editFlag', 'pages'));
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        try {

            $banner = Banner::findOrFail($id);
            // Validate the input
            $request->validate([
                'page' => 'required|string|max:255',
                'banner_title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'page_url' => 'nullable|string',
                'button_label' => 'nullable|string',
                'type' => 'required|in:carousel,single',
                'position' => 'nullable|integer',
                'is_active' => 'required|boolean',
            ]);

            // Update fields
            $banner->banner_title = $request->banner_title;
            $banner->page = $request->page;
            $banner->description = $request->description;
            $banner->page_url = $request->page_url;
            $banner->button_label = $request->button_label;
            $banner->type = $request->type;
            $banner->position = $request->position;
            $banner->is_active = $request->is_active;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Save to database as a blob or to storage
                $imagePath = file_get_contents($request->file('image')->getRealPath());
                $banner->image = $imagePath;
            }

            // Save the department
            $banner->save();
            return redirect()->route('bannerDetails')->with('success', 'Banner updated successfully.');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Update Banner', 'error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $banner->delete();
            return redirect()->route('bannerDetails')->with('success', 'Banner deleted successfully.');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Delete Banner', 'error' => $e->getMessage()]);
        }
    }
}
