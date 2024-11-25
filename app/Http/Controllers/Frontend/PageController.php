<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        return view('frontend.blogs');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
