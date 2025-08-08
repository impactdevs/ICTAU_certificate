<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $primaryKey = 'event_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'event_id',
        'topic',
        'start_date',
        'end_date',
        'venue',
        'venue_name',
        'certificate_template_path'
    ];

    // cast start and end dates to Carbon instances
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'event_date' => 'datetime', 
    ];

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->event_id = (string) \Illuminate\Support\Str::uuid();
        });
    }

    public function attendances()
{
    return $this->hasMany(Attendance::class, 'event_id', 'event_id');
}

}

