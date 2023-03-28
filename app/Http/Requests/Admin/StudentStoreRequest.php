<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StudentStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            'regNumber' => [
                'required',
                'numeric',
                'unique:users,regNumber'
            ],
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
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

    public function getNewStudentData(): array {
        $studentRole = Role::query()->where('slug', 'student')->first();
        $newStudentData = $this->validated();

        $newStudentData['password'] = Hash::make(value: $newStudentData['password']);
        $newStudentData['role_id'] = $studentRole->id;

        return $newStudentData;
    }
}
