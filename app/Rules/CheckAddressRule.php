<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
// use Illuminate\Contracts\Validation\ValidationRule;

class CheckAddressRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function passes($attribute, $value)
    {
        return ! is_numeric($value);
    }

    public function message()
    {
        return 'Trường :attribute không được nhập chỉ mỗi số';
    }

}
