<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChinesevocabRequest extends FormRequest
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
            'hanzi' => 'required|string',
            'pinyin' => 'required|string',
            'meaning' => 'required|string',
            'type' => 'required|in:noun,verb,adj,adv',
            'example_cn' => 'nullable|string',
            'example_id' => 'nullable|string',
            'level' => 'required|in:beginner,intermediate,advanced',
        ];
    }
}
