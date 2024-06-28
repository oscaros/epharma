<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'FirstName',
        'LastName',
        'Email',
        'Phone',
        'Address',
        'NIN',
        'PInsured',
        'PType'
        

    ];
}
