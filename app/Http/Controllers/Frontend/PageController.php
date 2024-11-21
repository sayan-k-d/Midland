<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Services;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index()
    {
        return view('frontend.index');
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
        return view('frontend.doctors');
    }

    public function blogs()
    {
        return view('frontend.blogs');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
