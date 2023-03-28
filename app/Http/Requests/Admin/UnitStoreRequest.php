<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UnitStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => [
                'required',
                'string',
                'unique:units,name'
            ],
            'course_id' => [
                'required',
                'numeric',
                'exists:courses,id'
            ]
        ];
    }

    public function getNewUnitData(): array {
        return $this->validated();
    }
}
