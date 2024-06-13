<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'question',
        'type'
    ];

    // public function response()
    // {
    //     return $this->hasMany('App\Models\FormResponse', 'form_id', 'id');
    // }

    public function formbuilder (): BelongsTo
    {
        return $this -> belongsTo(formBuilder::class);
    }

    
    public function response()
    {
        return $this->hasMany(FormResponse::class, 'form_id', 'id');
    }

}
