<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use App\Services\UserService\Data\LoginUserData;

class LoginRequest extends ApiRequest
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
        if ($this->input('login_type') === 'email') {
            return $this->emailRules();
        } else {
            return $this->loginRules();
        }
    }

    public function emailRules()
    {
        return [
            'email' => [
                'required',
                'max:254',
                'exists:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
                'regex:/^[^\s]*$/u',     //без пробелов
                'regex:/[a-zA-Zа-яА-Я]/u',  // должен содержать хотя бы одну букву (латинскую или русскую)
                'regex:/[0-9]/',            // должен содержать хотя бы одну цифру
            ],
        ];
    }

    public function loginRules()
    {
        return [
            'login' => [
                'required',
                'string',
                'alpha_num',
                'max:50',
                'min:3',
                'exists:users,login',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
                'regex:/^[^\s]*$/u',     //без пробелов
                'regex:/[a-zA-Zа-яА-Я]/u',  // должен содержать хотя бы одну букву (латинскую или русскую)
                'regex:/[0-9]/',            // должен содержать хотя бы одну цифру
            ],
        ];
    }

    public function data(): LoginUserData
    {
        return LoginUserData::from($this->validated());
    }
}
