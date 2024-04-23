<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'user_id',
        'type',
        'payment_mode',
        'reference',
        'amount',
        'description',
        'phone_number',
        'status',
        'order_tracking_id',
        'OrderNotificationType',
        'user_id',
        // 'child_id',
        'product_id',
        // 'child_ids',
        'product_ids',
        'per_child_amount'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // transaction belongs to a sponsor
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function child()
    // {
    //     return $this->belongsTo(Children::class);
    // }
}
