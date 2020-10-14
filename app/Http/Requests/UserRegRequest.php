<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users',
            'username' => 'required|string|min:8|max:100|unique:users',
            'password' => 'required|string|min:8|max:100|confirmed',
            'profile' => 'required|string|max:100',
            'skill_id' => 'nullable|string',
        ];
    }
}
