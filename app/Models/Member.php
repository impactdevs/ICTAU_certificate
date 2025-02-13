<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'membership_type_id',
        'email',
        'phone',
        'membership_id'
    ];

    //a member has a membership type
    public function membershipType()
    {
        return $this->belongsTo(MembershipType::class);
    }
}
