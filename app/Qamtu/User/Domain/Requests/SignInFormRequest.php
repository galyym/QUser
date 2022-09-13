<?php

namespace App\Qamtu\User\Domain\Requests;

use App\Http\Requests\APIRequest;

class SignInFormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'base64' => 'required',
            'password' => 'required|string',
        ];
    }

}
