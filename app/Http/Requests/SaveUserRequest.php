<?php

namespace App\Http\Requests;

use App\Rules\ValidateFacebook;
use App\Rules\ValidateYoutbe;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveUserRequest extends FormRequest
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
        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'phone' => ['required', 'numeric'],
            'address' => ['required'],
            'family_id' => ['required'],
            'gender' => ['required', 'in:1,2'],
            'avatar' => ['nullable', 'mimes:jpg,png', 'max:5000'],
            'facebook_url' => ['required', 'url', new ValidateFacebook],
            'twitter_url' => ['required', 'url'],
            'youtube_url' => ['required', 'url', new ValidateYoutbe],
            'zalo_phone' => ['nullable', 'numeric'],
            'other_info' => ['nullable'],
        ];

        //When create user

        if (empty($this->user)) {
            $rules['password'] = ['required', 'min:6'];
            $rules['password_confirm'] = ['required', 'same:password'];
        }

        //When update

        if (! empty($this->user)) {
            $rules['password'] = ['nullable', 'min:6'];
            $rules['password_confirm'] = ['nullable', 'same:password'];
        }

        return $rules;
    }
}
