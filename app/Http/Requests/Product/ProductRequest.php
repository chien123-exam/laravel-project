<?php

namespace App\Http\Requests\Product;

use App\Rules\CheckAddressRule;
use App\Rules\CheckNumberForPhoneRule;
use App\Rules\CheckValidateForYearRule;
use App\Rules\CheckValueForMemberRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'min:2', 'max:255'],
            'phone' => ['required', new CheckNumberForPhoneRule],
            'address' => ['required', 'min:5', new CheckAddressRule],
            'gender' => ['required', 'in:1,2'],
            'member' => ['required', new CheckValueForMemberRule],
            'year' => ['required', new CheckValidateForYearRule],
            'facebook_url' => ['required', 'url', 'starts_with:http://facebook.com/', 'regex:/^http:\/\/facebook\.com\/[a-zA-Z0-9_\-]+$/'],
            'file' => ['required', 'mimes:jpg,png', 'max:10000'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'gender' => 'Gender',
            'member' => 'Member',
            'year' => 'Year',
            'facebook_url' => 'facebook_url',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải chứa ít nhất :min kí tự',
            'max' => ':attribute không được vượt quá :max kí tự',
            'email' => ':attribute không đúng định dạng',
            'regex' => ':attribute không hợp lệ',
            'in' => ':attribute phải là 1 hoặc 2',
            'numeric' => ':attribute phải là số',
        ];
    }
}
