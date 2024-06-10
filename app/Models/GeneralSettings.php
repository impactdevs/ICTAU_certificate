<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    use HasFactory;

    protected $table = 'general__settings';

    protected $fillable = [
        'send_certificate_after',
        'send_welcome_email_after',
    ];
}
