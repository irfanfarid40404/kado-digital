<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageMedia extends Model
{
    use HasFactory;

    protected $table = 'page_media';

    protected $fillable = [
        'page_id',
        'type',
        'path',
        'caption',
        'order',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
