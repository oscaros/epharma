<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        //product name
        'name',
        //product price

        'price',
        //status
        'status',
        //product quantity
        'quantity',
        //product serial number auto generated as random number
        'serial_number',
        //expiry date as dateTime
        'expiry_date',
        //edit_approved_by as user_id
        'edit_approved_by',
        //edit_approved_at as dateTime
        'edit_approved_at'
        
    ];
}
