<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NoteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'image' => 'image'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Название не может быть пустым',
            'body.required' => 'Содержимое заметки не может быть пустым',
            'image.image' => 'Неверный формат файла'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors()), 400);
    }

}
