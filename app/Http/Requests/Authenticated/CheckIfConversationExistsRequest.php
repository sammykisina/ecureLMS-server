<?php

declare(strict_types=1);

namespace App\Http\Requests\Authenticated;

use Illuminate\Foundation\Http\FormRequest;

class CheckIfConversationExistsRequest extends FormRequest {
    public function rules(): array {
        return [
            'senderId' => [
                'required',
                'numeric',
                'exists:users,id'
            ],
            'receiverId' => [
                'required',
                'numeric',
                'exists:users,id'
            ]
        ];
    }
}
