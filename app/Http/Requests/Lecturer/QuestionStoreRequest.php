<?php

declare(strict_types=1);

namespace App\Http\Requests\Lecturer;

use Illuminate\Foundation\Http\FormRequest;

class QuestionStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            'question' => [
                'required',
                'string',
            ],
            'correctAnswer' => [
                'required',
                'string',
            ],
            'answers' => [
                'required',
                'array'
            ],
            'task_id' => [
                'required',
                'exists:tasks,id'
            ]
        ];
    }

    public function getNewTaskQnData(): array {
        return $this->validated();
    }
}
