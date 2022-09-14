<?php


namespace App\Qamtu\Request\Domain\Requests;

use App\Http\Requests\APIRequest;

class FormRequest extends APIRequest
{

    public function rules()
    {
        return [
            'status_id' => 'required|max:11',
            'iin' => 'required|max:12',
            'full_name' => 'required|max:255|string',
            'birthdate' => 'required|date',
            'privilege_id' => 'required',
            'positions' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|max:12',
            'address' => 'required|max:255|string',
            'second_phone_number' => 'required|max:12',
            'family_status' => 'required',
            'sex' => 'max:100',
            'comment' => 'max:1000',
        ];
    }

}
