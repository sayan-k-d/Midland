<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{

    protected $fillable = ['name', 'email', 'subject', 'phone', 'message'];
    // public $timestamps = false;
    protected $casts = [
        'created_at' => 'datetime',
    ];

}
