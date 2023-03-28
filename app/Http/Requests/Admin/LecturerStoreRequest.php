<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LecturerStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            'workNumber' => [
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
            'password' => [
                'required',
                'string'
            ],
            'unitIds' => [
                'required',
                'array',
            ]
        ];
    }

    public function getNewLecturerData(): array {
        $lecturerRole = Role::query()->where('slug', 'lecturer')->first();
        $newLecturerData = $this->validated();

        $newLecturerData['password'] = Hash::make(value: $newLecturerData['password']);
        $newLecturerData['regNumber'] = $newLecturerData['workNumber'];
        $newLecturerData['role_id'] = $lecturerRole->id;

        return $newLecturerData;
    }
}
