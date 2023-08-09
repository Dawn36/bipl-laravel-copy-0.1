<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $connection = 'mysql';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'otp_code',
        'expires_at',
    ];
}
