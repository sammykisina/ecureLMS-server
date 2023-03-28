<?php

declare(strict_types=1);

namespace App\Http\Requests\Authenticated;

use Illuminate\Foundation\Http\FormRequest;

class DiscussionUpdateRequest extends FormRequest {
    public function rules(): array {
        return [
            'discussion' => [
                'required',
                'string'
            ],
            'unit_id' => [
                'required',
                'numeric',
                'exists:units,id'
            ]
        ];
    }

    public function getUpdatedDiscussionData(): array {
        return $this->validated();
    }
}
