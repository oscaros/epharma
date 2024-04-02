<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_expenses',
        'total_income',
        'date',
        'additional_expenses',
        'additional_income',
    ];

    protected $casts = [
        'total_expenses' => 'float',
        'total_income' => 'float',
        'additional_expenses' => 'array',
        'additional_income' => 'array',
    ];
}
