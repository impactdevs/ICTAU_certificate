<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership_Type extends Model
{
    use HasFactory;
    protected $table = 'membership__types'; // Add if your table name is different

    protected $fillable = [
        'membership_type_name',
    ];
}
