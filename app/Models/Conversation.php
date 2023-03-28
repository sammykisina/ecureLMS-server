<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model {
    use HasFactory;

    protected $fillable = [
        'senderId',
        'receiverId',
        'lastTimeMessage'
    ];

    public function sender(): BelongsTo {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'senderId'
        );
    }

    public function receiver(): BelongsTo {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'receiverId'
        );
    }

    public function messages(): HasMany {
        return $this->hasMany(
            related: Message::class,
            foreignKey: 'conversation_id',
        )->orderBy('created_at', 'ASC');
    }
}
