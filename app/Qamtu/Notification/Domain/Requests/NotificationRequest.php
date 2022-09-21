<?php


namespace App\Qamtu\Request\Domain\Requests;

use App\Http\Requests\APIRequest;

class FormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'text_id' => 'required|max:11',
        ];
    }

}
