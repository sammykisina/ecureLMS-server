<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model {
    use HasFactory;

    protected $fillable = [
        'senderId',
        'receiverId',
        'conversation_id',
        'read',
        'type',
        'body'
    ];

    protected $casts = [
        'read' => 'boolean'
    ];

    public function conversation(): BelongsTo {
        return $this->belongsTo(
            related: Conversation::class,
            foreignKey: 'conversation_id'
        );
    }

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
}
