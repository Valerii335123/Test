<?php

namespace App\Http\Requests;

class UpdatePostRequest extends BaseRequest
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
            'title' => 'string|min:3|max:255',
            'preview_text' => 'string|min:3|max:255',
            'text' => 'string',
            'image' => 'nullable|file|image',
        ];
    }
}