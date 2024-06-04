<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportPhoto extends Model
{
    use HasFactory;

    protected $table = 'passport_photos';

    protected $fillable = [
        'applicant_id',
        'passport_photo',
    ];
}
