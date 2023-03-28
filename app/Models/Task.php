<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model {
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'icon',
        'numberOfQuestions',
        'timeToTakeInTask',
        'numberOfPointsForEachQuestion',
        'published',
        'lecturer_id',
        'unit_id',
        'bgColor',
        'dueDate',
        'numberOfValidDays'
    ];

    protected $casts = [
        'published' => 'boolean',
        'dueDate' => 'datetime'
    ];

    public function unit(): BelongsTo {
        return $this->belongsTo(
            related: Unit::class,
            foreignKey: 'unit_id'
        );
    }

    public function questions(): HasMany {
        return $this->hasMany(
            related: Question::class,
            foreignKey: 'task_id'
        );
    }

    public function results(): HasMany {
        return $this->hasMany(
            related:Result::class,
            foreignKey:'task_id'
        );
    }
}
