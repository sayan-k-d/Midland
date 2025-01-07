<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    use HasFactory;
    protected $fillable = [
        'service_name', 'image', 'innerImage', 'short_details', 'long_details', 'is_active',
    ];
    public $timestamps = false;
}
