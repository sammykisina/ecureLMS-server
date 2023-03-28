<?php

declare(strict_types=1);

namespace App\Http\Services\Lecturer;

use App\Models\Answer;
use App\Models\Question;

class TaskQnService {
    public function createTaskQn(array $newTaskQnData): Question {
        return Question::create($newTaskQnData);
    }

    public function createTaskQnAnswer(array $taskQnAnswerData): void {
        Answer::create($taskQnAnswerData);
    }
}
