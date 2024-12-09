<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    use HasFactory;
    protected $fillable = [
        'doctor_name', 'phone', 'email', 'image', 'doctor_post',
        'department', 'biography', 'education', 'experience',
        'languages', 'degree', 'workingSchedules', 'isHead', 'is_active', 'is_active_department', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube',
    ];
    public $timestamps = false;
}
