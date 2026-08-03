<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'theme',
        'recipient_name',
        'title',
        'story',
        'countdown_date',
        'slug',
        'status',
        'package',
    ];

    protected $casts = [
        'countdown_date' => 'datetime',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(PageMedia::class)->orderBy('order');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PageMedia::class)->where('type', 'photo')->orderBy('order');
    }

    public function audio(): HasOne
    {
        return $this->hasOne(PageMedia::class)->where('type', 'audio');
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function qrCode(): HasOne
    {
        return $this->hasOne(QrCode::class);
    }
}
