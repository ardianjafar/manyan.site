<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEngvocabRequest extends FormRequest
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
            'category_id'   => 'required|exists:categories,id',
            'word_en'       => 'required|string|max:255',
            'word_id'       => 'required|string|max:255',
            'type'          => 'required|in:noun,verb,adjective,adverb', // disesuaikan dengan enum type
            'example_en'    => 'nullable|string',
            'example_id'    => 'nullable|string',
            'level'         => 'required|in:beginner,intermediate,advanced', // disesuaikan dengan enum level
        ];
    }
}
