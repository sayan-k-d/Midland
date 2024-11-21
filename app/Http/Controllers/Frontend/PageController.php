<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index() {
        return view('frontend.index');
    }

    public function about() {
        return view('frontend.about');
    }

    public function departments() {
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
        return view('frontend.departments',['departments' => $data,"maxPageLimit" => $maxPageLimit, "totaldepartment" => $totaldepartment]);
    }

    public function services() {
        return view('frontend.services');
    }

    public function doctors() {
        return view('frontend.doctors');
    }

    public function blogs() {
        return view('frontend.blogs');
    }

    public function contact() {
        return view('frontend.contact');
    }
}
