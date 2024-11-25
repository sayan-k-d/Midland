<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentDetail;
use App\Models\ContactDetail;

class AdminFormController extends Controller
{
    public function getContactData(Request $req)
    {
       
        $contactData = null;
        $maxPageLimit = 10;
        $totalContacts = ContactDetail::count();
        if ($totalContacts > $maxPageLimit) {
            $contactData = ContactDetail::paginame($maxPageLimit);
        } else {
            $contactData = ContactDetail::all();
        }

        return view('cms.forms.contactDetails', ['contactData' => $contactData, "maxPageLimit" => $maxPageLimit, "totalContacts" => $totalContacts]);
    }
    public function getAppointmentData(Request $req)
    {
        $data = null;
        $maxPageLimit = 10;
        $totalAppoinments = AppointmentDetail::count();
        if ($totalAppoinments > $maxPageLimit) {
            $data = AppointmentDetail::paginame($maxPageLimit);
        } else {
            $data = AppointmentDetail::all();
        }
        

        return view('cms.forms.appointmentDetails', ['appoinments' => $data,  "maxPageLimit" => $maxPageLimit, "totalAppoinments" => $totalAppoinments]);
    }
}
