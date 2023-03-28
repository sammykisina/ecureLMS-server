<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model {
    use HasFactory;

    protected $fillable = [
        'question',
        'correctAnswer',
        'task_id'
    ];

    public function answers(): HasMany {
        return $this->hasMany(
            related: Answer::class,
            foreignKey: 'question_id'
        );
    }
}
