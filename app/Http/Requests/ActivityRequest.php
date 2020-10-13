<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'skill_id' => 'required|string|max:250',
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:600',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
        ];
    }
}
