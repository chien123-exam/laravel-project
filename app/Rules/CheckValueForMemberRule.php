<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckValueForMemberRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        return $value > 1;
    }

    public function message()
    {
        return 'Có ít nhất một kí tự được nhập vào';
    }
}
