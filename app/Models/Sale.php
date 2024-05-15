<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        //product ids as array of many products made in one sale
        'product_id',
        //sales total amount
        'amount',
        //user id who made the sale
        'user_id',
        'entity_id',
        'product_id',
               
            
                'reference' ,
               
               
                'status',
                'description' ,
                'phone_number' ,
                'payment_mode' ,
                'OrderNotificationType' ,
                'order_tracking_id' ,
                'type' ,
                'payment_method',

        
    ];

    //belongs to entity
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    //sale has many products
    // public function product()
    // { 
    //     return $this->hasMany(Product::class);
    // }

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    protected $casts = [
        'product_id' => 'array',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    



}
