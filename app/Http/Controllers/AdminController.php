<?php

namespace App\Http\Controllers;

use App\Models\AppointmentDetail;
use App\Models\ContactDetail;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\ReceiverEmail;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request $req)
    {
        try {
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
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Load Dashboard', 'error' => $e->getMessage()]);
        }
    }
    public function showEmailForm()
    {
        try {
            $receiverEmail = ReceiverEmail::first();
            return view('cms.layout.receiver-email-form', compact('receiverEmail'));
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }
    }
    public function setEmail(Request $req)
    {
        try {
            $validatedData = $req->validate([
                'receiverEmail' => 'required|email',
            ]);
            // dd($validatedData);
            $email = ReceiverEmail::first();
            $admin = Auth::user()->id;
            // dd($admin);
            if ($email) {
                $email->update(['receiver_email' => $req->input('receiverEmail'), 'user_id' => $admin]);
            } else {
                ReceiverEmail::create([
                    'receiver_email' => $req->input('receiverEmail'),
                    'user_id' => $admin,
                ]);
            }
            return redirect()->back()->with('success', "Receiver Email Updated Successfully");
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Update Receiver Email', 'error' => $e->getMessage()]);
        }
    }
    public function profile()
    {
        try {
            $user = Auth::user();
            return view('cms.profile', compact('user'));
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }

    }
    public function profileUpdate(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'role_id' => 'required|integer',
            ]);

            $user = User::findOrFail($id);
            // dd($user);
            $user->update($validated);

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Update Profile', 'error' => $e->getMessage()]);
        }

    }
    public function changePassword()
    {
        try {
            $user = Auth::user();
            return view('cms.changePassword', compact('user'));
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Open Page', 'error' => $e->getMessage()]);
        }

    }
    public function updatePassword(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()->with(['alertTitle' => 'Failed to Update Password', 'error' => $e->getMessage()]);
        }
    }

}
