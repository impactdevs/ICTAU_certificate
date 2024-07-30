<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'event_date',
        'venue',
        'venue_name',
        'certificate_template_path'
    ];

    protected $table = 'trainings';
}
