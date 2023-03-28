<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => [
                'required',
                'string',
                'unique:courses,name'
            ]
        ];
    }

    public function getNewCourseData(): array {
        return $this->validated();
    }
}
