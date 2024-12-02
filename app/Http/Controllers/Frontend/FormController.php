<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Mail\EnqueryMail;
use App\Models\AppointmentDetail;
use App\Models\ContactDetail;
use App\Models\Department;
use App\Models\ReceiverEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function storeContactDetail(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'msg' => 'required|string',
        ]);

        // Store the contact form data in the database
        ContactDetail::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'phone' => $request->input('phone'),
            'message' => $request->input('msg'),
        ]);
        $emailData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'phone' => $request->input('phone'),
            'message' => $request->input('msg'),

        ];
        $receiverEmail = ReceiverEmail::all()->first();
        // dd($receiverEmail);
        Mail::send(new ContactMail($emailData, $receiverEmail->receiver_email));
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
    public function storeAppointmentDetail(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'uname' => 'required|string|max:255', // Full Name
            'uemail' => 'required|email|max:255', // Email Address
            'unumber' => 'required|string|max:20', // Phone Number
            'udate' => 'required|string|date_format:m/d/Y|after:today', // Booking Date
            'udepartment' => 'required|string', // Department
            'udoctor' => 'required|string', // Doctor
            'umsg' => 'nullable|string', // Message
        ]);

        $bookingDate = \Carbon\Carbon::createFromFormat('m/d/Y', $request->input('udate'))->format('Y-m-d');
        $departmentId = Department::where('department_name', $request->input('udepartment'))->value('id');
        // dd($request->input('udate'), $bookingDate);
        // Store the appointment details in the database
        AppointmentDetail::create([
            'name' => $request->input('uname'),
            'email' => $request->input('uemail'),
            'phone' => $request->input('unumber'),
            'booking_date' => $bookingDate,
            'department' => $request->input('udepartment'),
            'doctor_name' => $request->input('udoctor'),
            'message' => $request->input('umsg'),
            'department_id' => $departmentId,
        ]);
        $emailData = [
            'name' => $request->input('uname'),
            'email' => $request->input('uemail'),
            'phone' => $request->input('unumber'),
            'booking_date' => $bookingDate,
            'department' => $request->input('udepartment'),
            'doctor_name' => $request->input('udoctor'),
            'message' => $request->input('umsg'),

        ];
        $receiverEmail = ReceiverEmail::all()->first();
        // dd($receiverEmail);
        Mail::send(new EnqueryMail($emailData, $receiverEmail->receiver_email));
        return redirect()->back()->with('success', 'Your message has been sent successfully!');

    }
}
