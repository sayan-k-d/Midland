<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
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
        return view('frontend.departments');
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
