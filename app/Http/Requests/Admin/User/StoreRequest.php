<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'role' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле должно быть запролненно',
            'name.string' => 'Это поле должно быть строкой',
            'email.required' => 'Это поле должно быть запролненно',
            'email.string' => 'Это поле должно быть строкой',
            'email.email' => 'Ваша почта должна соответствовать формату mail@some.domai',
            'email.unique' => 'Пользователь с таким же email уже есть',
            'role.integer' => 'Это поле должно быть цыфрой',
            'role.required' => 'Выберите роль пользователя',
        ];
    }
}
