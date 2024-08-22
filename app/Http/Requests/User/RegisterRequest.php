<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use App\Services\UserService\Data\RegisterUserData;

class RegisterRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
                'regex:/^[a-zA-Zа-яА-Я\s]+$/u', // Допускает латинские и русские буквы, а также пробелы
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:users',
                'max:254',
            ],
            'login' => [
                'required',
                'string',
                'alpha_num',
                'unique:users,login',
                'max:50',
                'min:3',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
                'confirmed',
                'regex:/^[^\s]*$/u',     //без пробелов
                'regex:/[a-zA-Zа-яА-Я]/u',  // должен содержать хотя бы одну букву (латинскую или русскую)
                'regex:/[0-9]/',            // должен содержать хотя бы одну цифру
            ],
        ];
    }

    public function data(): RegisterUserData
    {
        return RegisterUserData::from($this->validated());
    }
}
