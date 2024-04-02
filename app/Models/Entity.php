<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name'
    ];

    //has many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //has many users
    public function users()
    {
        return $this->hasMany(User::class);
    }

}
