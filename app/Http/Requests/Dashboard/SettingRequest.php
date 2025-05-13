<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_name.*' => 'required|string|max:255',

            'site_desc.*' => 'required|string|max:500',

            'site_phone' => 'required|string|max:20',

            'site_address.*' => 'required|string|max:255',

            'site_email' => 'required|email|max:255',
            'site_email_support' => 'required|email|max:255',

            'site_facebook_url' => 'required|url|max:255',
            'site_twitter_url' => 'required|url|max:255',
            'site_instagram_url' => 'required|url|max:255',
            'site_whatsapp_url' => 'required|url|max:255',

            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:512',

            'site_meta_description.*' => 'required|string|min:60|max:500',

            'site_copyright' => 'required|string|max:255',
            'site_promotion_video_url' => 'required|url|max:255',
        ];
    }
}
