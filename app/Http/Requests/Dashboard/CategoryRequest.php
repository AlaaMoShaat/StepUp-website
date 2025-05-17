<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Dashboard\ValidParentCategory;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CategoryRequest extends FormRequest
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
       $categoryId = $this->route('category');
        $rules = [
           'name.*' => ['required', 'min:2', 'max:60', UniqueTranslationRule::for('categories', 'name')->ignore($categoryId)],
           'status' => ['required', 'in:0,1'],
           'parent' => ['sometimes', 'integer', 'exists:categories,id', new ValidParentCategory()],
        ];

        return $rules;
    }
}
