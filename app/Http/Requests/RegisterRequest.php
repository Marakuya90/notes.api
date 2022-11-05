<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login' => 'required|unique:users,login',
            'password' => 'required|min:6'
        ];
    }

    public function messages(){
        return [
            'login.required' => 'Поле логин не может быть пустым',
            'login.unique' => 'Пользователь с таким логином уже зарегистрирован',
            'password.required' => 'Пароль не может быть пустым',
            'password.min' => 'Длина пароля не может быть меньше 6 символов'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors()), 400);
    }


}
