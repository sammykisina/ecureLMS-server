<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LecturerUpdateRequest extends FormRequest {
    public function rules(): array {
        return [
            'workNumber' => [
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

     public function getUpdatedLecturerData(): array {
         $updatedLecturerData = $this->validated();

         $updatedLecturerData['password'] = Hash::make(value: $updatedLecturerData['password']);
         $updatedLecturerData['regNumber'] = $updatedLecturerData['workNumber'];

         return $updatedLecturerData;
     }
}
