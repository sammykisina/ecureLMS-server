<?php

declare(strict_types=1);

namespace App\Http\Requests\Authenticated;

use Illuminate\Foundation\Http\FormRequest;

class MessageStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            'receiverId' => [
                'required',
                'numeric',
                'exists:users,id'
            ],
            'senderId' => [
                'required',
                'numeric',
                'exists:users,id'
            ],
            'body' => [
                'string',
                'required'
            ]
        ];
    }

    public function getNewMessageData(): array {
        return $this->validated();
    }
}
