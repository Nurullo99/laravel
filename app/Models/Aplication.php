<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Aplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject',
        'message',
        'file_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
