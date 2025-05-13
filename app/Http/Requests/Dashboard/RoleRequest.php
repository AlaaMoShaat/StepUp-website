<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class RoleRequest extends FormRequest
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
        $role_id = $this->route('role');
        return [
            'role.*' => ['required', 'min:2', 'max:60', UniqueTranslationRule::for('roles', 'role')->ignore($role_id)],
            'permessions' => ['required', 'array', 'min:1'],
        ];
    }
}