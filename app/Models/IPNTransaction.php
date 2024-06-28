<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPNTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time',
        'amount',
        'narrative',
        'network_ref',
        'external_ref',
        'msisdn',
        'payer_names',
        'payer_email',
        'signature',


    ];
}
