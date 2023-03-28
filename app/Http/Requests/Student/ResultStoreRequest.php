<?php

declare(strict_types=1);

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class ResultStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            'points' => [
                'required',
                'numeric'
            ],
            'task_id' => [
                'required',
                'numeric',
                'exists:tasks,id'
            ],
            'student_id' => [
                'required',
                'numeric',
                'exists:users,id'
            ]
        ];
    }

    public function getNewResultData(): array {
        return $this->validated();
    }
}
