<?php

namespace App\Http\Controllers;

use App\Models\AppointmentDetail;
use App\Models\ContactDetail;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

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

        return view('cms.forms.appointmentDetails', ['appoinments' => $data, "maxPageLimit" => $maxPageLimit, "totalAppoinments" => $totalAppoinments]);
    }
    public function editreschedule($id)
    {
        // Fetch the appointment by ID
        $appointment = AppointmentDetail::findOrFail($id);
        // dd($appointment->doctor_name);
        // Fetch related data like departments and doctors if needed
        $departments = Department::all();
        $doctors = Doctor::all();

        // Return the edit form view with data
        return view('cms.forms.rescheduleAppointment', compact('appointment', 'departments', 'doctors'));
    }
    public function reschedule(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'uname' => 'required|string|max:255',
            'uemail' => 'required|email',
            'unumber' => 'required|string|max:15',
            'udate' => 'required|date|after:today',
            'udepartment' => 'required|string',
            'udoctor' => 'required|string',
            'umsg' => 'nullable|string',
        ]);
        // dd($validated);
        // $bookingDate = \Carbon\Carbon::createFromFormat('m/d/Y', $request->input('udate'))->format('Y-m-d');
        $departmentId = Department::where('department_name', $request->input('udepartment'))->value('id');
        $data = [
            'name' => $validated['uname'],
            'email' => $validated['uemail'],
            'phone' => $validated['unumber'],
            'booking_date' => $validated['udate'],
            'department_id' => $departmentId,
            'department' => $validated['udepartment'],
            'doctor_name' => $validated['udoctor'],
            'message' => $validated['umsg'],
        ];
        // dd($data);

        $appointment = AppointmentDetail::findOrFail($id);
        // dd($appointment);
        $appointment->update($data);

        return redirect("appointmentDetails")->with('success', 'Appointment rescheduled successfully.');
    }

    public function destroyAppointment($id)
    {
        // Find the service by its ID
        $appointment = AppointmentDetail::findOrFail($id);

        // Perform soft delete
        $appointment->delete();

        return redirect()->route('appointmentDetails')->with('success', 'Appointment deleted successfully.');
    }
    public function destroyContact($id)
    {
        // Find the service by its ID
        $contact = ContactDetail::findOrFail($id);

        // Perform soft delete
        $contact->delete();

        return redirect()->route('contactDetails')->with('success', 'Contact deleted successfully.');
    }
}
