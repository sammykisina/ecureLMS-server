<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentUpdateRequest extends FormRequest {
    public function rules(): array {
        return [
            'regNumber' => [
                'required',
                'numeric',
                Rule::unique('users', 'regNumber')->ignore(id: $this->id),
            ],
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(id: $this->id),
            ],
            'course_id' => [
                'required',
                'numeric',
                'exists:courses,id'
            ],
            'password' => [
                'required',
                'string'
            ]
        ];
    }

    public function getUpdateStudentData(): array {
        $updateEmployeeData = $this->validated();
        $updateEmployeeData['password'] = Hash::make(value: $updateEmployeeData['password']);

        return $updateEmployeeData;
    }
}
