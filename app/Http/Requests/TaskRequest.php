<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'text' => 'required|string',
            'user_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'text.required' => 'Task text is required',
            'text.string' => 'Task text must be string',
            'user_id.required' => 'Task user is required',
            'user_id.integer' => 'Task user must be integer',
        ];
    }
}
