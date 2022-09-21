<?php
namespace App\Qamtu\Resume\Domain\Requests;

use App\Http\Requests\APIRequest;

class AddRequest extends APIRequest
{
    public function rules()
    {
        return [
            'iin' => 'required|integer|min:12|unique:applicant',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:applicant',
            'birthdate' => 'required|date',
            'phone_number' => 'required|integer|min:12',
        ];
    }

    public function messages()
    {
        return [
            'iin.required' => 'Поля IIN должно быть заполнено',
            'iin.integer' => 'Поля IIN должно быть только цифры',
            'full_name.required' => 'Поля ФИО должно быть заполнено',
            'email.required' => 'Поля email должно быть заполнено',
            'birthdate.required' => 'Укажите свое дата рождение',
            'phone_number.required' => 'Вы не указали свой номер телефона'
        ];
    }
}
