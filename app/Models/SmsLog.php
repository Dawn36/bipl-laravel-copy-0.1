<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $connection = 'mysql';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'otp_code',
        'mobile_no',
        'expires_at',
        'created_at',
        'updated_at',
    ];
}
