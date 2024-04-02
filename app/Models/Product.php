<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        //product name
        'name',
        //product price
        'price',
        //product quantity
        'quantity',
        //product serial number auto generated as random number
        'serial_number',
        //entity
        'entity_id',
        //expiry date as dateTime
        'expiry_date',
        //edit_approved_by as user_id
        'edit_approved_by',
        //edit_approved_at as dateTime
        'edit_approved_at'
        
    ];

    //belongs to entity
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
