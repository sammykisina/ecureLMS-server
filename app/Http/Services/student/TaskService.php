<?php

declare(strict_types=1);

namespace App\Http\Services\Student;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class TaskService {
    public function getTasks(): Collection {
        return QueryBuilder::for(subject: Task::class)
                           ->allowedIncludes(includes: ['unit','questions.answers'])
                           ->defaultSort('-created_at')
                           ->get();
    }
}
