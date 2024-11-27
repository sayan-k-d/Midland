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
        'meta_header', 'meta_desc', 'title', 'date', 'content', 'content_image', 'intro_heading', 'introduction', 'intro_image', 'video_heading', 'video_link',
        'video_content', 'diet_heading', 'diet_image', 'diet_description', 'diet_content', 'diet_advice', 'test_heading', 'test_content', 'is_recent', 'tags', 'created_by',
    ];
}
