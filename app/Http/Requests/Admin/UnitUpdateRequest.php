<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitUpdateRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('units', 'name')->ignore(id: $this->id),
            ],
            'course_id' => [
                'required',
                'numeric',
                'exists:courses,id'
            ]
        ];
    }

    public function getUpdateUnitData(): array {
        return $this->validated();
    }
}
