<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class StoreRequest extends FormRequest
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
        $storeId = $this->route('store');

        $rules =  [
            'name.*' => ['required', 'min:2', 'max:60', UniqueTranslationRule::for('stores')->ignore($storeId)],

            'logo' => $this->method() == 'PUT' ? ['nullable', 'max:2048'] : ['required', 'max:2048'],

            'website_url' => ['nullable', 'url', 'max:255'],

            'email' => ['nullable', 'email','max:255', 'unique:stores,email,'.$storeId ],

            'phone' => ['required', 'regex:/^(\+?\d{1,4})?[-\s.]?(\d{6,14})$/'],


            'importance_level' => ['required', 'in:featured,normal,low'],

            'status' => ['required', 'in:0,1'],

            'branches' => ['required', 'array', 'min:1'],

            'branches.*.neighborhood_id' => ['required', 'exists:neighborhoods,id'],

            'branches.*.address' => ['required', 'string', 'max:255'],

            'branches.*.location' => ['required', 'string'],

            'branches.*.days' => ['required', 'array', 'min:1'],

            'branches.*.days.*.enabled' => ['sometimes', 'boolean'],

            'branches.*.days.*.open_time' => [
                'required_if:branches.*.days.*.enabled,1',
                'date_format:H:i',
                'before:branches.*.days.*.close_time'
            ],

            'branches.*.days.*.close_time' => [
                'required_if:branches.*.days.*.enabled,1',
                'date_format:H:i',
                'after:branches.*.days.*.open_time'
            ]
        ];

        return $rules;
    }
}
