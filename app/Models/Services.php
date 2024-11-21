<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Services extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_name', 'image', 'short_details', 'long_details',
    ];
    public $timestamps = false;
}
