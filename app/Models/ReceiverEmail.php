<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class ReceiverEmail extends Model
{
    use HasFactory;
    protected $table = 'receiver_email'; // Explicitly set table name if it's not pluralized
    protected $fillable = ['receiver_email', 'user_id']; // Mass-assignable fields

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
