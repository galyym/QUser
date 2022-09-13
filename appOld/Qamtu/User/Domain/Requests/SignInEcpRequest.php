<?php

namespace App\Qamtu\User\Domain\Requests;

class SignInEcpRequestfdd{

    public function rules(): array
    {
        return [
            'base64' => 'required|format:base64',
            'password' => 'required|string',
        ];
    }
}
