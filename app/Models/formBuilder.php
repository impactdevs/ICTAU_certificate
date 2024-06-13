<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formBuilder extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'name',
        'type',
        'created_by',
    ];

    public static $fieldTypes = [
        'text' => 'Text',
        'email' => 'Email',
        'number' => 'Number',
        'date' => 'Date',
        'textarea' => 'Textarea',
    ];

    public function form_field()
    {
        return $this->hasMany('App\Models\FormField', 'form_id', 'id');
    }

     public function formFields()
    {
        return $this->hasMany(formField::class, 'form_id', 'id');
    }

    public function response()
    {
        return $this->hasMany(FormResponse::class, 'form_id', 'id');
    }

}
