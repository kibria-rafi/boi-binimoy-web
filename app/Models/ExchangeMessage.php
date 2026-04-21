<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExchangeMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'exchange_request_id',
        'sender_id',
        'receiver_id',
        'body',
    ];

    public function exchangeRequest(): BelongsTo
    {
        return $this->belongsTo(ExchangeRequest::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
