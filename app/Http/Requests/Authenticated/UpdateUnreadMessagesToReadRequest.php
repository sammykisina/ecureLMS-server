<?php

declare(strict_types=1);

namespace App\Http\Requests\Authenticated;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnreadMessagesToReadRequest extends FormRequest {
    public function rules(): array {
        return [
            'unreadMessagesIds' => [
                'required',
                'array'
            ]
        ];
    }
}
