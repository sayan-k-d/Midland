<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentConfirmation;
use App\Mail\EnqueryMail;
use App\Models\AppointmentDetail;
use App\Models\ContactDetail;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\ReceiverEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminFormController extends Controller
{
    public function getContactData(Request $req)
    {
        try {
            $contactData = null;
            $maxPageLimit = 10;
            $totalContacts = ContactDetail::count();
            if ($totalContacts > $maxPageLimit) {
                $contactData = ContactDetail::paginate($maxPageLimit);
            } else {
                $contactData = ContactDetail::all();
            }

            return view('cms.forms.contactDetails', ['contactData' => $contactData, "maxPageLimit" => $maxPageLimit, "totalContacts" => $totalContacts]);
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Load Contact Data', 'error' => $e->getMessage()]);
        }
    }
    public function getAppointmentData(Request $req)
    {
        try {
            $data = null;
            $maxPageLimit = 10;
            $totalAppoinments = AppointmentDetail::count();
            if ($totalAppoinments > $maxPageLimit) {
                $data = AppointmentDetail::orderBy('booking_date', 'desc')->paginate($maxPageLimit);
            } else {
                $data = AppointmentDetail::orderBy('booking_date', 'desc')->get();
            }

            return view('cms.forms.appointmentDetails', ['appoinments' => $data, "maxPageLimit" => $maxPageLimit, "totalAppoinments" => $totalAppoinments]);
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Load Appointment Data', 'error' => $e->getMessage()]);
        }
    }
    public function editreschedule($id)
    {
        try {
            // Fetch the appointment by ID
            $appointment = AppointmentDetail::findOrFail($id);
            // dd($appointment->doctor_name);
            // Fetch related data like departments and doctors if needed
            $departments = Department::where('is_active', true)->get();
            $doctors = Doctor::where('is_active', true)->where('is_active_department', true)->get();

            // Return the edit form view with data
            return view('cms.forms.rescheduleAppointment', compact('appointment', 'departments', 'doctors'));
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }
    }
    public function reschedule(Request $request, $id)
    {
        try {

            // dd($request->all());
            $validated = $request->validate([
                'uname' => 'required|string|max:255',
                'uemail' => 'required|email',
                'unumber' => 'required|string|max:13',
                'udate' => 'required|date|after:today',
                'udepartment' => 'required|string',
                'udoctor' => 'required|string',
                'umsg' => 'nullable|string',
            ]);
            // dd($validated);
            // $bookingDate = \Carbon\Carbon::createFromFormat('m/d/Y', $request->input('udate'))->format('Y-m-d');
            $departmentName = Department::where('id', $request->input('udepartment'))->value('department_name');
            $data = [
                'name' => $validated['uname'],
                'email' => $validated['uemail'],
                'phone' => $validated['unumber'],
                'booking_date' => $validated['udate'],
                'department_id' => $validated['udepartment'],
                'department' => $departmentName,
                'doctor_name' => $validated['udoctor'],
                'message' => $validated['umsg'],
            ];
            // dd($data);

            $appointment = AppointmentDetail::findOrFail($id);
            // dd($appointment);
            $appointment->update($data);
            $emailData = [
                'name' => $request->input('uname'),
                'email' => $request->input('uemail'),
                'phone' => $request->input('unumber'),
                'booking_date' => $request->input('udate'),
                'department' => $request->input('udepartment'),
                'doctor_name' => $request->input('udoctor'),
                'message' => $request->input('umsg'),

            ];
            $receiverEmail = ReceiverEmail::all()->first();

            Mail::send(new EnqueryMail($emailData, $receiverEmail->receiver_email));
            Mail::send(new AppointmentConfirmation("Appointment Rescheduled", $emailData, $request->input('uemail')));
            return redirect("appointmentDetails")->with('success', 'Appointment rescheduled successfully.');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Reschedule Appointment', 'error' => $e->getMessage()]);
        }
    }

    public function destroyAppointment($id)
    {
        try {
            // Find the service by its ID
            $appointment = AppointmentDetail::findOrFail($id);

            // Perform soft delete
            $appointment->delete();

            return redirect()->route('appointmentDetails')->with('success', 'Appointment deleted successfully.');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Delete Appointment', 'error' => $e->getMessage()]);
        }
    }
    public function destroyContact($id)
    {
        try {
            // Find the service by its ID
            $contact = ContactDetail::findOrFail($id);

            // Perform soft delete
            $contact->delete();

            return redirect()->route('contactDetails')->with('success', 'Contact deleted successfully.');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Delete Contact', 'error' => $e->getMessage()]);
        }
    }
}
