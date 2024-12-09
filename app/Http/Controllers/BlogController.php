<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $blog->image = $this->encodeImage($blog->image);
        }
        return view("cms.blogs.index", ['blogs' => $data, "maxPageLimit" => $maxPageLimit, "totalBlogs" => $totalBlogs]);
    }

    public function create()
    {
        $editFlag = false;
        $blog = null;
        $user = Auth::user();
        return view('cms.blogs.addBlog', compact('blog', 'editFlag', 'user'));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'short_description' => 'required|string',
            'slug' => 'nullable|string',
            'tags' => 'nullable|string',
            'created_by' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'meta_header' => 'nullable|string',
            'meta_desc' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);
        $image = $request->hasFile('image') ? $this->processImage($request->file('image')) : null;

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->short_description = $request->short_description;
        $blog->slug = $request->slug;
        $blog->tags = $request->tags;
        $blog->created_by = $request->created_by;
        $blog->meta_header = $request->meta_header;
        $blog->meta_desc = $request->meta_desc;
        $blog->image = $image;
        $blog->is_active = $request->is_active;

        $blog->save();

        return redirect('blogDetails')->with('success', 'Blog created successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $editFlag = true; // Flag for edit mode
        $blog->image = $this->encodeImage($blog->image);
        return view('cms.blogs.addBlog', compact('blog', 'editFlag'));
    }
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Validate the input
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'short_description' => 'required|string',
            'slug' => 'nullable|string',
            'tags' => 'nullable|string',
            'created_by' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'meta_header' => 'nullable|string',
            'meta_desc' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->short_description = $request->short_description;
        $blog->slug = $request->slug;
        $blog->tags = $request->tags;
        $blog->created_by = $request->created_by;
        $blog->meta_header = $request->meta_header;
        $blog->meta_desc = $request->meta_desc;
        $blog->is_active = $request->is_active;

        if ($request->hasFile('image')) {
            $blog->image = $this->processImage($request->file('image'));
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
