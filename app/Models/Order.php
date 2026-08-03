<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'amount',
        'package',
        'payment_method',
        'status',
        'paid_at',
        'dummy_reference_code',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
