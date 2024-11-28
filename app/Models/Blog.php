<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    use HasFactory;

    protected $fillable = [
        'meta_header', 'meta_desc', 'title', 'content', 'image', 'short_description', 'slug', 'tags', 'created_by',
    ];
}
