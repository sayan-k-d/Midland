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
        $doctors = Doctor::all();
        foreach ($doctors as $doctor) {
            if ($doctor->image) {
                $doctor->image = $this->encodeImage($doctor->image);
            }
            if ($doctor->department) {
                $doctor->department = Department::findOrFail($doctor->department)->department_name;
            }
        }
        $departments = Department::all();
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
        $blogs = Blog::all();
        foreach ($blogs as $blog) {
            if ($blog->image) {
                $blog->image = $this->encodeImage($blog->image);
            }
        }
        // dd($banners);
        return view('frontend.index', ['doctors' => $doctors, 'departments' => $departments, 'banners' => $banners, 'blogs' => $blogs]);
    }

    public function about()
    {

        return view('frontend.about');
    }

    public function departments()
    {
        $data = null;
        $maxPageLimit = 10;
        $totaldepartment = Department::count();
        if ($totaldepartment > $maxPageLimit) {
            $data = Department::paginate($maxPageLimit);
        } else {
            $data = Department::all();
        }

        foreach ($data as $department) {
            if ($department->image) {
                $department->image = $this->encodeImage($department->image);
            }
        }
        return view('frontend.departments', ['departments' => $data, "maxPageLimit" => $maxPageLimit, "totaldepartment" => $totaldepartment]);
    }

    public function departmentDetails($id)
    {
        $department = Department::findOrFail($id);
        $doctors = Doctor::all();
        $departments = Department::all();
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
        $totalServices = Services::count();
        if ($totalServices > $maxPageLimit) {
            $data = Services::paginate($maxPageLimit);
        } else {
            $data = Services::all();
        }

        foreach ($data as $service) {
            if ($service->image) {
                $service->image = $this->encodeImage($service->image);
            }
        }
        return view('frontend.services', ['services' => $data, "maxPageLimit" => $maxPageLimit, "totalServices" => $totalServices]);
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
        $totalDoctors = Doctor::count();
        // dd($totalDoctors);
        if ($totalDoctors > $maxPageLimit) {
            $data = Doctor::paginate($maxPageLimit);
        } else {
            $data = Doctor::all();
        }
        // dd($data);
        foreach ($data as $doctor) {
            if ($doctor->image) {
                $doctor->image = $this->encodeImage($doctor->image);
            }
            if ($doctor->department) {
                $department = Department::findOrFail($doctor->department);
                $departmentName = $department->department_name;
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

        return view('frontend.doctors', ['doctors' => $data, 'hod' => $hod, 'departmentName' => $departmentName, "maxPageLimit" => $maxPageLimit, "totalDoctors" => $totalDoctors, 'schedules' => $schedules]);
    }
    public function doctorProfile($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctors = Doctor::all();
        if ($doctor->image) {
            $doctor->image = $this->encodeImage($doctor->image);
        }
        if ($doctor->department) {
            $department = Department::findOrFail($doctor->department);
            $departmentName = $department->department_name;
        }
        $workingSchedules = explode(',', $doctor->workingSchedules);
        $schedules = [];
        foreach ($workingSchedules as $schedule) {
            $schedule = explode('=', $schedule);
            $schedules[] = $schedule;
        }
        $departments = Department::all();
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
        $totalBlogs = Blog::count();
        if ($totalBlogs > $maxPageLimit) {
            $data = Blog::paginate($maxPageLimit);
        } else {
            $data = Blog::all();
        }

        foreach ($data as $blog) {
            $blog->image = $this->encodeImage($blog->image);
        }

        return view('frontend.blogs', ['blogs' => $data, "maxPageLimit" => $maxPageLimit, "totalBlogs" => $totalBlogs]);
    }
    public function blogDetails($id)
    {
        $blog = Blog::findOrFail($id);

        $nextBlog = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first();
        $prevBlog = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();

        $blog->image = $this->encodeImage($blog->image);

        // $recentBlogs = Blog::where('is_recent', 1)->paginate(5);
        $recentBlogs = Blog::where('created_at', '>=', now()->subDays(3))->orderBy('created_at', 'desc') // Sort by newest
            ->take(5) // Limit to 5 records
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

        // $recentBlogs = Blog::where('is_recent', 1)->get();
        $recentBlogs = Blog::where('created_at', '>=', now()->subDays(3))
            ->orderBy('created_by', 'desc')
            ->get();
        $maxPageLimit = 10;
        $totalBlogs = $recentBlogs->count();
        if ($totalBlogs > $maxPageLimit) {
            $recentBlogs = $recentBlogs = Blog::where('created_at', '>=', now()->subDays(3))
                ->orderBy('created_by', 'desc')->paginate($maxPageLimit);
        }

        foreach ($recentBlogs as $recentBlog) {
            $recentBlog->image = $this->encodeImage($recentBlog->image);
        }
        return view('frontend.blog-right-sidebar', ['blog' => $blog, 'recentBlogs' => $recentBlogs, 'totalBlogs' => $totalBlogs, 'maxPageLimit' => $maxPageLimit]);
    }

    public function contact()
    {
        return view('frontend.contact');
    }
    public function appointment()
    {
        $departments = Department::all();
        $doctors = Doctor::all();
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
