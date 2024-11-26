<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppointmentDetail;
use App\Models\ContactDetail;
use App\Models\Doctor;
use App\Models\Department;

class AdminFormController extends Controller
{
    public function getContactData(Request $req)
    {
       
        $contactData = null;
        $maxPageLimit = 10;
        $totalContacts = ContactDetail::count();
        if ($totalContacts > $maxPageLimit) {
            $contactData = ContactDetail::paginate($maxPageLimit);
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
            $data = AppointmentDetail::paginate($maxPageLimit);
        } else {
            $data = AppointmentDetail::all();
        }
        

        return view('cms.forms.appointmentDetails', ['appoinments' => $data,  "maxPageLimit" => $maxPageLimit, "totalAppoinments" => $totalAppoinments]);
    }
    public function reschedule(Request $request, $id)
    {
        $validated = $request->validate([
            'uname' => 'required|string|max:255',
            'uemail' => 'required|email',
            'unumber' => 'required|string|max:15',
            'udate' => 'required|date|after:today',
            'udepartment' => 'required|string',
            'udoctor' => 'required|string',
            'umsg' => 'nullable|string',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($validated);

        return redirect()->back()->with('success', 'Appointment rescheduled successfully.');
    }
    public function editreschedule($id)
    {
        // Fetch the appointment by ID
        $appointment = AppointmentDetail::findOrFail($id);

        // Fetch related data like departments and doctors if needed
        $departments = Department::all();
        $doctors = Doctor::all();

        // Return the edit form view with data
        return view('cms.forms.rescheduleAppointment', compact('appointment', 'departments', 'doctors'));
    }
    public function destroyAppointment($id)
    {
        // Find the service by its ID
        $appointment = AppointmentDetail::findOrFail($id);

        // Perform soft delete
        $appointment->delete();

        return redirect()->route('appointmentDetails')->with('success', 'Service deleted successfully.');
    }
    public function destroyContact($id)
    {
        // Find the service by its ID
        $contact = ContactDetail::findOrFail($id);

        // Perform soft delete
        $contact->delete();

        return redirect()->route('contactDetails')->with('success', 'Service deleted successfully.');
    }
}
