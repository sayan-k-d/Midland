<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AppointmentDetail;
use App\Models\ContactDetail;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getData(Request $req)
    {
        $data = null;
        $contactData = null;
        $maxPageLimit = 10;
        $totalAppoinments = AppointmentDetail::count();
        $totalContacts = ContactDetail::count();
        if ($totalAppoinments > $maxPageLimit) {
            $data = AppointmentDetail::paginame($maxPageLimit);
        } else {
            $data = AppointmentDetail::all();
        }

        if ($totalContacts > $maxPageLimit) {
            $contactData = ContactDetail::paginame($maxPageLimit);
        } else {
            $contactData = ContactDetail::all();
        }
        $admin = Admin::where('email', 'sayan@test.com')
            ->where('password', 'password123')
            ->first();

        return view('cms.dashboard', ['appoinments' => $data, 'contactData' => $contactData, "maxPageLimit" => $maxPageLimit, "totalAppoinments" => $totalAppoinments, "totalContacts" => $totalContacts, "admin" => $admin]);
    }

    public function setEmail(Request $req)
    {
        if ($req->input('recieverEmail')) {
            $admin = Admin::where('email', 'sayan@test.com')
                ->where('password', 'password123')
                ->first();
            $admin->recieverEmail = $req->input('recieverEmail');
            $admin->save();
            return redirect()->back()->with('success', "Reciever Email Updated Succesfully");
        }
    }
}
