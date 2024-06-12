<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'form_field_id',
        'response'
    ];

    public function formField()
    {
        return $this->belongsTo(FormField::class, 'form_field_id', 'id');
    }

}
