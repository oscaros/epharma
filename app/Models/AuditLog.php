<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'event_type',
        'business_id',
        'branch_id',
        'ip_address',
        'user_agent',
        'method',
        'date'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
