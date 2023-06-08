<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'title' => 'required',
            'code' => 'required|min:3',
            'style_id' => 'required|numeric|exists:App\Models\CodeStyle,id',
            'language_id' => 'required|numeric|exists:App\Models\CodeLanguage,id',
        ];

        if (request()->isMethod('PUT')) {
            $rules = array_merge($rules, [
                'id' => 'required|exists:App\Models\Code,id',
            ]);
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'title.required' => 'Please input a title',
            'code.min' => 'Please input a longer code',
            'style_id.required' => 'Please select a style',
            'language_id.required' => 'Please select a language',
            'style_id.exists' => 'The selected style is not a supported style',
            'language_id.exists' => 'The selected language is not a supported language',
        ];

        if (request()->isMethod('PUT')) {
            $messages = array_merge($messages, [
                'id.required' => "Record does not exist!",
                'id.exists' => "Record does not exist!",
            ]);
        }

        return $messages;
    }
}
