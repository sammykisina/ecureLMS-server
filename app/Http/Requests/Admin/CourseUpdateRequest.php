<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseUpdateRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('courses', 'name')->ignore(id: $this->id),
            ]
        ];
    }

    public function getUpdatedStudentData(): array {
        return $this->validated();
    }
}
