<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'parentId' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:75',
            'metaTitle' => 'nullable|string|max:100',
            'slug' => 'nullable|string|max:100',
            'content' => 'nullable|string',
        ];
    }
}
