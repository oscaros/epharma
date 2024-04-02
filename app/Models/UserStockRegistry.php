<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStockRegistry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stock_id',
        'quantity',
        'price',
        'total',
        'type',
        'branch_id',
        'business_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }


    public function business()
    {
        return $this->belongsTo(Business::class);
    }


    
}
