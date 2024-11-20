<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentDetailsMail;
use App\Models\AppointmentDetail;
use App\Models\ContactDetail;
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

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
    public function storeAppointmentDetail(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'uname' => 'required|string|max:255', // Full Name
            'uemail' => 'required|email|max:255', // Email Address
            'unumber' => 'required|string|max:20', // Phone Number
            'udate' => 'required|string', // Booking Date
            'udepartment' => 'required|string', // Department
            'udoctor' => 'required|string', // Doctor
            'umsg' => 'nullable|string', // Message
        ]);

        $bookingDate = \Carbon\Carbon::createFromFormat('m/d/Y', $request->input('udate'))->format('Y-m-d');

        // Store the appointment details in the database
        AppointmentDetail::create([
            'name' => $request->input('uname'),
            'email' => $request->input('uemail'),
            'phone' => $request->input('unumber'),
            'booking_date' => $bookingDate,
            'department' => $request->input('udepartment'),
            'doctor_name' => $request->input('udoctor'),
            'message' => $request->input('umsg'),
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
        try {
            // Send the email
            Mail::to('sayankd2001@gmail.com')->send(new AppointmentDetailsMail($emailData));

            // Return success response
            return redirect()->back()->with('success', 'Appointment has been successfully scheduled, and an email has been sent!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error sending email: ' . $e->getMessage());

            // Return error response
            return redirect()->back()->with('error', 'Appointment was scheduled, but the email could not be sent. Please try again later.');
        }
        // Mail::to('sayankumar.d2000@gmail.com')->send(new AppointmentDetailsMail($emailData));
        // // Redirect back with a success message
        // return redirect()->back()->with('success', 'Appointment has been successfully scheduled!');
    }
}
