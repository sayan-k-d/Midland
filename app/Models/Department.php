<?php

namespace App\Models;

use App\Models\AppointmentDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'department_name', 'image', 'short_details', 'long_details',
    ];
    public function appointments()
    {
        return $this->hasMany(AppointmentDetail::class);
    }
    public $timestamps = false;
}
