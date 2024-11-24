<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class AppointmentDetail extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'booking_date', 'department', 'doctor_name', 'message', 'department_id'];
    // public $timestamps = false;
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
