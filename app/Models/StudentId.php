<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentId extends Model
{
    use HasFactory;

    protected $table = 'student_ids';

    protected $fillable = [
        'applicant_id',
        'student_id',
    ];
}
