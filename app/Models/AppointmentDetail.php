<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentDetail extends Model
{
    protected $fillable = ['name', 'email', 'phone','booking_date', 'department','doctor_name', 'message'];
}
