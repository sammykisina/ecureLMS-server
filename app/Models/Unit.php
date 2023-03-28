<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id'
    ];

    public function course(): BelongsTo {
        return $this->belongsTo(
            related: Course::class,
            foreignKey: 'course_id'
        );
    }
}
