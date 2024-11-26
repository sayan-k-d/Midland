<?php

namespace App\Http\Controllers;

use App\Models\AppointmentDetail;
use App\Models\ContactDetail;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request $req)
    {
        $appointmentsCount = AppointmentDetail::count();
        $doctorsCount = Doctor::count();
        $servicesCount = Services::count();
        $departmentsCount = Department::count();

        // Sample data for charts
        $appointmentsByMonth = AppointmentDetail::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $departmentsDistribution = Department::withCount('appointments')->get()->pluck('appointments_count', 'department_name');
        $upcomingAppointments = AppointmentDetail::whereDate('booking_date', '>=', now())
            ->orderBy('booking_date')
            ->take(5)
            ->get();
        $appointmentsCalendar = AppointmentDetail::select('id', 'name as title', 'booking_date as start')
            ->get()
            ->toArray();
        $recentContacts = ContactDetail::latest()->take(5)->get(); // Assuming an ActivityLog model

        return view('cms.dashboard', compact(
            'appointmentsCount',
            'doctorsCount',
            'servicesCount',
            'departmentsCount',
            'appointmentsByMonth',
            'departmentsDistribution',
            'upcomingAppointments',
            'appointmentsCalendar',
            'recentContacts'
        ));
        // $data = null;
        // $contactData = null;
        // $maxPageLimit = 10;
        // $totalAppoinments = AppointmentDetail::count();
        // $totalContacts = ContactDetail::count();
        // if ($totalAppoinments > $maxPageLimit) {
        //     $data = AppointmentDetail::paginame($maxPageLimit);
        // } else {
        //     $data = AppointmentDetail::all();
        // }

        // if ($totalContacts > $maxPageLimit) {
        //     $contactData = ContactDetail::paginame($maxPageLimit);
        // } else {
        //     $contactData = ContactDetail::all();
        // }
        // // $admin = Admin::where('email', 'sayan@test.com')
        // //     ->where('password', 'password123')
        // //     ->first();
        // $admin = Auth::user();
        // return view('cms.dashboard', ['appoinments' => $data, 'contactData' => $contactData, "maxPageLimit" => $maxPageLimit, "totalAppoinments" => $totalAppoinments, "totalContacts" => $totalContacts, "admin" => $admin]);
    }

    public function setEmail(Request $req)
    {
        if ($req->input('receiverEmail')) {
            $admin = Auth::user();
            $admin->receiverEmail()->create([
                'receiver_email' => $req->input('receiverEmail'),
            ]);
            return redirect()->back()->with('success', "Receiver Email Updated Successfully");
        }
    }
    public function profile()
    {
       
            $user = Auth::user();
            
            return view('cms.profile',compact('user'));
       
    }
    public function profileUpdate(Request $request, $id)
    {
       
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role_id' => 'required|integer',
        ]);
    
        $user = User::findOrFail($id);
        // dd($user);
        $user->update($validated);
    
        return redirect()->back()->with('success', 'Profile updated successfully!');
       
    }
    public function changePassword()
    {
       
            $user = Auth::user();
            
            return view('cms.changePassword',compact('user'));
       
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();


        if (!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update the password
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

}
