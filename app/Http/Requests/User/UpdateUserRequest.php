<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use App\Services\UserService\Data\UpdateUserData;

class UpdateUserRequest extends ApiRequest
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
                'nullable',
                'string',
                'max:255',
                'min:3',
                'regex:/^[a-zA-Zа-яА-Я\s]+$/u', // Допускает латинские и русские буквы, а также пробелы
            ],
            'email' => [
                'nullable',
                'email:rfc,dns',
                'unique:users',
                'max:254',
            ],
            'login' => [
                'nullable',
                'string',
                'alpha_num',
                'unique:users,login',
                'max:50',
                'min:3',
            ],
            'about' => [
                'nullable',
                'string',
                'max:1000',
                'min:5',
            ],
        ];
    }

    public function data(): UpdateUserData
    {
        return UpdateUserData::from($this->validated());
    }
}
