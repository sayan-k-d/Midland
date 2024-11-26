<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_buffer($finfo, $doctor->image);
                finfo_close($finfo);
                $doctor->image = 'data:' . $mimeType . ';base64,' . base64_encode($doctor->image);
            }
        }
        $departments = Department::all();
        return view('frontend.index', ['doctors' => $doctors, 'departments' => $departments]);
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
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_buffer($finfo, $department->image);
                finfo_close($finfo);
                $department->image = 'data:' . $mimeType . ';base64,' . base64_encode($department->image);
            }
        }
        return view('frontend.departments', ['departments' => $data, "maxPageLimit" => $maxPageLimit, "totaldepartment" => $totaldepartment]);
    }

    public function departmentDetails($id)
    {
        $department = Department::findOrFail($id);
        if ($department->image) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $department->image);
            finfo_close($finfo);
            $department->image = 'data:' . $mimeType . ';base64,' . base64_encode($department->image);
        }
        return view('frontend.departments-details', ['department' => $department]);
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
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_buffer($finfo, $service->image);
                finfo_close($finfo);
                $service->image = 'data:' . $mimeType . ';base64,' . base64_encode($service->image);
            }
        }
        return view('frontend.services', ['services' => $data, "maxPageLimit" => $maxPageLimit, "totalServices" => $totalServices]);
    }
    public function serviceDetails($id)
    {
        $service = Services::findOrFail($id);
        if ($service->image) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $service->image);
            finfo_close($finfo);
            $service->image = 'data:' . $mimeType . ';base64,' . base64_encode($service->image);
        }
        return view('frontend.service-details', ['service' => $service]);
    }
    public function doctors()
    {
        $data = null;
        $maxPageLimit = 10;
        $totalDoctors = Doctor::count();
        if ($totalDoctors > $maxPageLimit) {
            $data = Doctor::paginate($maxPageLimit);
        } else {
            $data = Doctor::all();
        }
        // dd($data);
        foreach ($data as $doctor) {
            if ($doctor->image) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_buffer($finfo, $doctor->image);
                finfo_close($finfo);
                $doctor->image = 'data:' . $mimeType . ';base64,' . base64_encode($doctor->image);
            }
            if ($doctor->department) {
                $department = Department::findOrFail($doctor->department);
                $departmentName = $department->department_name;
            }
            if ($doctor->isHead == 1) {
                $hod = $doctor;
            }
        }

        $workingSchedules = explode(',', $doctor->workingSchedules);
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
        if ($doctor->image) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $doctor->image);
            finfo_close($finfo);
            $doctor->image = 'data:' . $mimeType . ';base64,' . base64_encode($doctor->image);
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
        return view('frontend.doctor-profile', ['doctor' => $doctor, 'schedules' => $schedules, 'departmentName' => $departmentName, 'departments' => $departments]);
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
            $blog->content_image = $this->encodeImage($blog->content_image);
            $blog->intro_image = $this->encodeImage($blog->intro_image);
            $blog->diet_image = $this->encodeImage($blog->diet_image);
        }

        return view('frontend.blogs', ['blogs' => $data, "maxPageLimit" => $maxPageLimit, "totalBlogs" => $totalBlogs]);
    }
    public function blogDetails($id)
    {
        $blog = Blog::findOrFail($id);

        $nextBlog = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first();
        $prevBlog = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();

        $blog->content_image = $this->encodeImage($blog->content_image);
        $blog->intro_image = $this->encodeImage($blog->intro_image);
        $blog->diet_image = $this->encodeImage($blog->diet_image);

        $dietContents = explode('.', $blog->diet_content);
        array_pop($dietContents);
        $diets = [];
        foreach ($dietContents as $content) {
            $content = explode(':', $content);
            $diets[] = $content;
        }

        $recentBlogs = Blog::where('is_recent', 1)->paginate(5);
        foreach ($recentBlogs as $recentBlog) {
            $recentBlog->content_image = $this->encodeImage($recentBlog->content_image);
            $recentBlog->intro_image = $this->encodeImage($recentBlog->intro_image);
            $recentBlog->diet_image = $this->encodeImage($recentBlog->diet_image);
        }

        return view('frontend.blog-details', ['blog' => $blog, 'diets' => $diets, 'recentBlogs' => $recentBlogs, 'nextBlog' => $nextBlog, 'prevBlog' => $prevBlog]);
    }

    public function recentBlogDetails($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->content_image = $this->encodeImage($blog->content_image);
        $blog->intro_image = $this->encodeImage($blog->intro_image);
        $blog->diet_image = $this->encodeImage($blog->diet_image);

        $recentBlogs = Blog::where('is_recent', 1)->get();
        $maxPageLimit = 10;
        $totalBlogs = $recentBlogs->count();
        if ($totalBlogs > $maxPageLimit) {
            $recentBlogs = Blog::where('is_recent', 1)->paginate($maxPageLimit);
        }

        foreach ($recentBlogs as $recentBlog) {
            $recentBlog->content_image = $this->encodeImage($recentBlog->content_image);
            $recentBlog->intro_image = $this->encodeImage($recentBlog->intro_image);
            $recentBlog->diet_image = $this->encodeImage($recentBlog->diet_image);
        }
        return view('frontend.blog-right-sidebar', ['blog' => $blog, 'recentBlogs' => $recentBlogs, 'totalBlogs' => $totalBlogs, 'maxPageLimit' => $maxPageLimit]);
    }

    public function contact()
    {
        return view('frontend.contact');
    }

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
