<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:courses',
            'slug' => 'required|string|unique:courses',
            'link' => 'required|url',
            'price' => 'required|numeric|min:0',
            'old_price' => 'required|numeric|min:0',
            'created_by' => 'required|numeric',
            'category_id' => 'required|numeric',
            'lessons' => 'required|numeric',
            'view_count' => 'nullable|numeric|min:0',
            'benefits' => 'nullable',
            'fqa' => 'nullable',
            'is_feature' => 'required|boolean',
            'is_online' => 'required|boolean',
            'description' => 'required|string',
            'content' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_desc' => 'required|string',
            'meta_keyword' => 'required|string',
        ];
    }
}
