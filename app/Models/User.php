<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'regNumber',
        'role_id',
        'course_id',
        'twoFactorCode',
        'twoFactorExpiresAt'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'twoFactorExpiresAt' =>  'datetime'
    ];

    public function generateTwoFactorCode(): void {
        $this->timestamps = false;

        $this->twoFactorCode = rand(100000, 999999);
        $this->twoFactorExpiresAt = now()->addMinutes(value: 10);
        $this->save();
    }

    public function resetTwoFactorCode() {
        $this->timestamps = false; //Dont update the 'updated_at' field yet

        $this->twoFactorCode = null;
        $this->twoFactorExpiresAt = null;
        $this->save();
    }

    public function role(): BelongsTo {
        return $this->belongsTo(
            related:Role::class,
            foreignKey: 'role_id'
        );
    }

    public function course(): BelongsTo {
        return $this->belongsTo(
            related:Course::class,
            foreignKey: 'course_id'
        );
    }

    public function units(): BelongsToMany {
        return $this->belongsToMany(
            related: Unit::class,
            table: 'lecturer_unit',
            foreignPivotKey: 'lecturer_id',
            relatedPivotKey: 'unit_id'
        );
    }

    public function tasks(): HasMany {
        return $this->hasMany(
            related: Task::class,
            foreignKey: 'lecturer_id'
        )->orderBy('created_at', 'DESC');
    }

    public function results(): HasMany {
        return $this->hasMany(
            related: Result::class,
            foreignKey: 'student_id'
        );
    }
}
