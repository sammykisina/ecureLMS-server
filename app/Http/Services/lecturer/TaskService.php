<?php

declare(strict_types=1);

namespace App\Http\Services\Lecturer;

use App\Models\Task;

class TaskService {
    public function createTask(array $newTaskData): Task {
        return Task::create($newTaskData);
    }

    public function updateTask(array $updatedTaskData, Task $task): bool {
        return $task->update($updatedTaskData);
    }

    public function deleteTask(Task $task): bool {
        return $task->delete();
    }
}
