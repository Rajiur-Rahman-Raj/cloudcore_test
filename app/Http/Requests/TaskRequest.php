<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'title' => 'required|string|min:3|max:100',
            'details' => 'required|string|min:5|max:5000',
            'due_date' => 'required|date',
            'status' => 'required|integer|in:0,1,2',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required',
            'title.string' => 'The title must be a valid string.',
            'title.min' => 'The title must be at least 3 characters long.',
            'title.max' => 'The title cannot exceed 100 characters.',

            'details.required' => 'Details are required and cannot be empty.',
            'details.string' => 'Details must be a valid string.',
            'details.min' => 'Details must be at least 5 characters long.',
            'details.max' => 'Details cannot exceed 5000 characters.',

            'due_date.required' => 'A due date is required.',
            'due_date.date' => 'The due date must be a valid date.',

            'status.required' => 'The status is required.',
            'status.integer' => 'The status must be an integer.',
            'status.in' => 'The status must be one of the following values: 0, 1, or 2.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->is('api/*')) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422));
        }

        parent::failedValidation($validator);
    }
}
