<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model {
    use HasFactory;

    protected $fillable = [
        'points',
        'task_id',
        'student_id'
    ];

    public function task(): BelongsTo {
        return $this->belongsTo(
            related: Task::class,
            foreignKey: 'task_id'
        );
    }

    public function student(): BelongsTo {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'student_id'
        );
    }
}
