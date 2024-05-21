<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'receipt_no',
        'amount',
        'payment_of',
        'payment_mode',
        'received_by',
        'cheque_no',
        'balance'
    ];
}
