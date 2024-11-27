<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private function encodeImage($content)
    {
        if ($content) {
            // Detect MIME type
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $content);
            finfo_close($finfo);
            return 'data:' . $mimeType . ';base64,' . base64_encode($content);
        }
        return null;
    }

    private function processImage($content)
    {
        return file_get_contents($content->getRealPath());
    }
    public function index()
    {
        $data = null;
        $maxPageLimit = 10;
        $totalBlogs = Blog::count();
        if ($totalBlogs > $maxPageLimit) {
            $data = Blog::paginate($maxPageLimit);
        } else {
            $data = Blog::all();
        }
        foreach ($data as $blog) {
            $blog->content_image = $this->encodeImage($blog->content_image);
            $blog->intro_image = $this->encodeImage($blog->intro_image);
            $blog->diet_image = $this->encodeImage($blog->diet_image);
        }
        return view("cms.blogs.index", ['blogs' => $data, "maxPageLimit" => $maxPageLimit, "totalBlogs" => $totalBlogs]);
    }

    public function create()
    {
        $editFlag = false;
        $blog = null;
        return view('cms.blogs.addBlog', compact('blog', 'editFlag'));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string',
            'date' => 'required|string',
            'content' => 'required|string',
            'content_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'intro_heading' => 'required|string|max:100',
            'introduction' => 'required|string',
            'intro_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'video_heading' => 'required|string|max:100',
            'video_link' => 'required|string',
            'video_content' => 'required|string',
            'diet_heading' => 'required|string|max:100',
            'diet_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'diet_description' => 'required|string',
            'diet_content' => 'required|string',
            'diet_advice' => 'nullable|string',
            'test_heading' => 'required|string|max:100',
            'test_content' => 'required|string',
            'is_recent' => 'nullable|in:checked',
            'tags' => 'required|string',
            'created_by' => 'nullable|string|max:100',
            'meta_header' => 'nullable|string',
            'meta_desc' => 'nullable|string',
        ]);
        $contentBlob = $request->hasFile('content_image') ? $this->processImage($request->file('content_image')) : null;
        $introBlob = $request->hasFile('intro_image') ? $this->processImage($request->file('intro_image')) : null;
        $dietBlob = $request->hasFile('diet_image') ? $this->processImage($request->file('diet_image')) : null;

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->date = $request->date;
        $blog->content = $request->content;
        $blog->content_image = $contentBlob;
        $blog->intro_heading = $request->intro_heading;
        $blog->introduction = $request->introduction;
        $blog->intro_image = $introBlob;
        $blog->video_heading = $request->video_heading;
        $blog->video_link = $request->video_link;
        $blog->video_content = $request->video_content;
        $blog->diet_heading = $request->diet_heading;
        $blog->diet_image = $dietBlob;
        $blog->diet_description = $request->diet_description;
        $blog->diet_content = $request->diet_content;
        $blog->diet_advice = $request->diet_advice;
        $blog->test_heading = $request->test_heading;
        $blog->test_content = $request->test_content;
        $blog->tags = $request->tags;
        $blog->created_by = $request->created_by;
        $blog->meta_header = $request->meta_header;
        $blog->meta_desc = $request->meta_desc;
        if ($request->has('is_recent') && $request->is_recent == 'checked') {
            $blog->is_recent = 1;
        } else {
            $blog->is_recent = 0;
        }
        $blog->save();

        return redirect('blogDetails')->with('success', 'Blog created successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $editFlag = true; // Flag for edit mode
        $blog->content_image = $this->encodeImage($blog->content_image);
        $blog->intro_image = $this->encodeImage($blog->intro_image);
        $blog->diet_image = $this->encodeImage($blog->diet_image);

        return view('cms.blogs.addBlog', compact('blog', 'editFlag'));
    }
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Validate the input
        $request->validate([
            'title' => 'required|string',
            'date' => 'required|string',
            'content' => 'required|string',
            'content_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'intro_heading' => 'required|string|max:100',
            'introduction' => 'required|string',
            'intro_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'video_heading' => 'required|string|max:100',
            'video_link' => 'required|string',
            'video_content' => 'required|string',
            'diet_heading' => 'required|string|max:100',
            'diet_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'diet_description' => 'required|string',
            'diet_content' => 'required|string',
            'diet_advice' => 'nullable|string',
            'test_heading' => 'required|string|max:100',
            'test_content' => 'required|string',
            'is_recent' => 'nullable|in:checked',
            'tags' => 'required|string',
            'created_by' => 'nullable|string|max:100',
            'meta_header' => 'nullable|string',
            'meta_desc' => 'nullable|string',
        ]);

        $blog->title = $request->title;
        $blog->date = $request->date;
        $blog->content = $request->content;
        $blog->intro_heading = $request->intro_heading;
        $blog->introduction = $request->introduction;
        $blog->video_heading = $request->video_heading;
        $blog->video_link = $request->video_link;
        $blog->video_content = $request->video_content;
        $blog->diet_heading = $request->diet_heading;
        $blog->diet_description = $request->diet_description;
        $blog->diet_content = $request->diet_content;
        $blog->diet_advice = $request->diet_advice;
        $blog->test_heading = $request->test_heading;
        $blog->test_content = $request->test_content;
        $blog->tags = $request->tags;
        $blog->created_by = $request->created_by;
        $blog->meta_header = $request->meta_header;
        $blog->meta_desc = $request->meta_desc;

        // Handle image upload

        if ($request->hasFile('content_image')) {
            $contentBlob = file_get_contents($request->file('content_image')->getRealPath());
            $blog->content_image = $contentBlob; // Replace 'image_blob' with your actual column name for the image
        }
        if ($request->hasFile('intro_image')) {
            $introBlob = file_get_contents($request->file('intro_image')->getRealPath());
            $blog->intro_image = $introBlob; // Replace 'image_blob' with your actual column name for the image
        }
        if ($request->hasFile('diet_image')) {
            $dietBlob = file_get_contents($request->file('diet_image')->getRealPath());
            $blog->diet_image = $dietBlob; // Replace 'image_blob' with your actual column name for the image
        }

        if ($request->has('is_recent') && $request->is_recent == 'checked') {
            $blog->is_recent = 1;
        } else {
            $blog->is_recent = 0;
        }
        $blog->save();

        return redirect()->route('blogDetails')->with('success', 'Blog updated successfully.');
    }
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogDetails')->with('success', 'Blog deleted successfully.');
    }

}
