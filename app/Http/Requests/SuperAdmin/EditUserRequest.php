<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:120'],
            'email' => ['required', 'email'],
            'mobile' => ['required'],
            'status' => ['nullable', 'integer'],
        ];
    }
}