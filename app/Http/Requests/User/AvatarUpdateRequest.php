<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Http\UploadedFile;

class AvatarUpdateRequest extends ApiRequest
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
            'avatar' => [
                'nullable',
                'image',
                'max:500', // Максимальный размер 500 кБ
                'mimes:jpeg,png,jpg,gif', // Разрешены только эти типы файлов
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000', // Ограничение на размеры изображения
            ],
        ];
    }

    public function avatar(): ?UploadedFile
    {
        return $this->file('avatar');
    }
}
