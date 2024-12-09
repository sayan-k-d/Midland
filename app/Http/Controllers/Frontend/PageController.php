<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Services;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('is_active', true)->where('is_active_department', true)->get();
        foreach ($doctors as $doctor) {
            if ($doctor->image) {
                $doctor->image = $this->encodeImage($doctor->image);
            }
            if ($doctor->department) {
                $doctor->department = Department::findOrFail($doctor->department)->department_name;
            }
            if ($doctor->isHead == 1) {
                $hod = $doctor;
            }
        }
        // dd($doctors);
        $departments = Department::where('is_active', true)->get();
        $banners = Banner::where('page', 'Home')
            ->where('type', 'carousel')
            ->where('is_active', true)
            ->orderBy('position')
            ->get();
        foreach ($banners as $banner) {
            if ($banner->image) {
                $banner->image = $this->encodeImage($banner->image);
            }
        }
        $blogs = Blog::where('is_active', true)->get();
        foreach ($blogs as $blog) {
            if ($blog->image) {
                $blog->image = $this->encodeImage($blog->image);
            }
        }
        // dd($banners);
        return view('frontend.index', ['doctors' => $doctors, 'hod' => $hod, 'departments' => $departments, 'banners' => $banners, 'blogs' => $blogs]);
    }

    public function about()
    {
        $banners = Banner::where('page', 'About')
            ->where('type', 'single')
            ->where('is_active', true)
            ->orderBy('position')
            ->get();
        foreach ($banners as $banner) {
            if ($banner->image) {
                $banner->image = $this->encodeImage($banner->image);
            }
        }
        $doctor = Doctor::where('isHead', true)->first();
        if ($doctor->image) {
            $doctor->image = $this->encodeImage($doctor->image);
        }
        // dd($banners );
        return view('frontend.about', ['banners' => $banners, 'hod' => $doctor]);
    }

    public function departments()
    {
        $data = null;
        $maxPageLimit = 10;
        $totaldepartment = Department::where('is_active', true)->count();
        if ($totaldepartment > $maxPageLimit) {
            $data = Department::where('is_active', true)->paginate($maxPageLimit);
        } else {
            $data = Department::where('is_active', true)->get();
        }

        foreach ($data as $department) {
            if ($department->image) {
                $department->image = $this->encodeImage($department->image);
            }
        }
        $banners = Banner::where('page', 'Departments')
            ->where('type', 'single')
            ->where('is_active', true)
            ->orderBy('position')
            ->get();
        foreach ($banners as $banner) {
            if ($banner->image) {
                $banner->image = $this->encodeImage($banner->image);
            }
        }
        // dd($banners);
        return view('frontend.departments', ['departments' => $data, "maxPageLimit" => $maxPageLimit, "totaldepartment" => $totaldepartment, 'banners' => $banners]);
    }

    public function departmentDetails($id)
    {
        $department = Department::findOrFail($id);
        $doctors = Doctor::where('is_active', true)->where('is_active_department', true)->get();
        $departments = Department::where('is_active', true)->get();
        if ($department->image) {
            $department->image = $this->encodeImage($department->image);
        }
        foreach ($doctors as $doc) {
            if ($doc->image) {
                $doc->image = $this->encodeImage($doc->image);
            }
        }
        return view('frontend.departments-details', ['department' => $department, 'departments' => $departments, 'doctors' => $doctors]);
    }
    public function services()
    {
        $data = null;
        $maxPageLimit = 10;
        $totalServices = Services::where('is_active', true)->count();
        if ($totalServices > $maxPageLimit) {
            $data = Services::where('is_active', true)->paginate($maxPageLimit);
        } else {
            $data = Services::where('is_active', true)->get();
        }

        foreach ($data as $service) {
            if ($service->image) {
                $service->image = $this->encodeImage($service->image);
            }
        }
        $banners = Banner::where('page', 'Services')
            ->where('type', 'single')
            ->where('is_active', true)
            ->orderBy('position')
            ->get();
        foreach ($banners as $banner) {
            if ($banner->image) {
                $banner->image = $this->encodeImage($banner->image);
            }
        }
        // dd($banners);
        return view('frontend.services', ['services' => $data, "maxPageLimit" => $maxPageLimit, "totalServices" => $totalServices, 'banners' => $banners]);
    }
    public function serviceDetails($id)
    {
        $service = Services::findOrFail($id);

        if ($service->image) {
            $service->image = $this->encodeImage($service->image);
        }
        return view('frontend.service-details', ['service' => $service]);
    }
    public function doctors()
    {
        $data = null;
        $maxPageLimit = 10;
        $totalDoctors = Doctor::where('is_active', true)->where('is_active_department', true)->count();
        // dd($totalDoctors);
        if ($totalDoctors > $maxPageLimit) {
            $data = Doctor::where('is_active', true)->where('is_active_department', true)->paginate($maxPageLimit);
        } else {
            $data = Doctor::where('is_active', true)->where('is_active_department', true)->get();
        }
        // dd($data);
        foreach ($data as $doctor) {
            if ($doctor->image) {
                $doctor->image = $this->encodeImage($doctor->image);
            }
            if ($doctor->department) {
                $department = Department::findOrFail($doctor->department);
                $doctor->department = $department->department_name;
                // dd($departmentName);
            }
            if ($doctor->isHead == 1) {
                $hod = $doctor;
            }
        }

        // dd($data);
        $workingSchedules = explode(',', $doctor->workingSchedules);
        // dd($doctor->workingSchedules);
        $schedules = [];
        foreach ($workingSchedules as $schedule) {
            $schedule = explode('=', $schedule);
            $schedules[] = $schedule;
        }
        $banners = Banner::where('page', 'Doctors')
            ->where('type', 'single')
            ->where('is_active', true)
            ->orderBy('position')
            ->get();
        foreach ($banners as $banner) {
            if ($banner->image) {
                $banner->image = $this->encodeImage($banner->image);
            }
        }
        // dd($banners);

        return view('frontend.doctors', ['doctors' => $data, 'hod' => $hod, "maxPageLimit" => $maxPageLimit, "totalDoctors" => $totalDoctors, 'schedules' => $schedules, 'banners' => $banners]);
    }
    public function doctorProfile($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctors = Doctor::where('is_active', true)->where('is_active_department', true)->get();
        if ($doctor->image) {
            $doctor->image = $this->encodeImage($doctor->image);
        }
        if ($doctor->department) {
            $department = Department::findOrFail($doctor->department);
            $departmentName = $department->department_name;
        }
        $workingSchedules = array_filter(
            explode(',', $doctor->workingSchedules),
            fn($schedule) => !is_null($schedule) && trim($schedule) !== ''
        );
        $schedules = [];
        foreach ($workingSchedules as $schedule) {
            $schedule = explode('=', $schedule);
            $schedules[] = $schedule;
        }
        // dd($schedules);
        $departments = Department::where('is_active', true)->get();
        return view('frontend.doctor-profile', ['doctor' => $doctor, 'schedules' => $schedules, 'departmentName' => $departmentName, 'departments' => $departments, 'doctors' => $doctors]);
    }
    public function doctorProfilet2()
    {
        return view('frontend.doctor-profile-t2');
    }

    public function blogs()
    {
        $data = null;
        $maxPageLimit = 10;
        $totalBlogs = Blog::where('is_active', true)->count();
        if ($totalBlogs > $maxPageLimit) {
            $data = Blog::where('is_active', true)->paginate($maxPageLimit);
        } else {
            $data = Blog::where('is_active', true)->get();
        }

        foreach ($data as $blog) {
            $blog->image = $this->encodeImage($blog->image);
        }
        $banners = Banner::where('page', 'Blogs')
            ->where('type', 'single')
            ->where('is_active', true)
            ->orderBy('position')
            ->get();
        foreach ($banners as $banner) {
            if ($banner->image) {
                $banner->image = $this->encodeImage($banner->image);
            }
        }
        // dd($banners);
        return view('frontend.blogs', ['blogs' => $data, "maxPageLimit" => $maxPageLimit, "totalBlogs" => $totalBlogs, 'banners' => $banners]);
    }
    public function blogDetails($id)
    {
        $blog = Blog::findOrFail($id);

        $nextBlog = Blog::where('id', '>', $id)->where('is_active', true)->orderBy('id', 'asc')->first();
        $prevBlog = Blog::where('id', '<', $id)->where('is_active', true)->orderBy('id', 'desc')->first();

        $blog->image = $this->encodeImage($blog->image);

        // $recentBlogs = Blog::where('is_recent', 1)->paginate(5);
        // $recentBlogs = Blog::where('is_active', true)->where('created_at', '>=', now()->subDays(3))->orderBy('created_at', 'desc') // Sort by newest
        //     ->take(5) // Limit to 5 records
        //     ->get();
        $recentBlogs = Blog::where('is_active', true) // Ensure the blog is active
            ->orderBy('created_at', 'desc') // Sort by newest
            ->take(3) // Limit to 3 latest records
            ->get();
        foreach ($recentBlogs as $recentBlog) {
            $recentBlog->image = $this->encodeImage($recentBlog->image);
        }

        return view('frontend.blog-details', ['blog' => $blog, 'recentBlogs' => $recentBlogs, 'nextBlog' => $nextBlog, 'prevBlog' => $prevBlog]);
    }

    public function recentBlogDetails($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->image = $this->encodeImage($blog->image);

        $recentBlogs = Blog::where('is_active', true)->orderBy('created_at', 'desc')->take(3)->get();
        $blogs = Blog::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
        $maxPageLimit = 10;
        $totalBlogs = $blogs->count();
        if ($totalBlogs > $maxPageLimit) {
            $blogs = Blog::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->paginate($maxPageLimit);
        }

        foreach ($blogs as $blog) {
            $blog->image = $this->encodeImage($blog->image);
        }
        foreach ($recentBlogs as $recentBlog) {
            $recentBlog->image = $this->encodeImage($recentBlog->image);
        }

        return view('frontend.blog-right-sidebar', ['blog' => $blog, 'blogs' => $blogs, 'recentBlogs' => $recentBlogs, 'totalBlogs' => $totalBlogs, 'maxPageLimit' => $maxPageLimit]);
    }

    public function contact()
    {
        $banners = Banner::where('page', 'Contact')
            ->where('type', 'single')
            ->where('is_active', true)
            ->orderBy('position')
            ->get();
        foreach ($banners as $banner) {
            if ($banner->image) {
                $banner->image = $this->encodeImage($banner->image);
            }
        }
        // dd($banners);
        return view('frontend.contact', ['banners' => $banners]);
    }
    public function appointment()
    {
        $departments = Department::where('is_active', true)->get();
        $doctors = Doctor::where('is_active', true)->where('is_active_department', true)->get();
        return view('frontend.appointment', ['doctors' => $doctors, 'departments' => $departments]);
    }
    // public function showDepartment()
    // {
    //     $departments = Department::all();
    //     return view('frontend.layouts.footer', ['departments' => $departments]);
    // }

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
}
