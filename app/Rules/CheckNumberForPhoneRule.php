<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckNumberForPhoneRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        return $value[0] == 0 && strlen($value) == 10;
    }

    public function message()
    {
        return 'Sđt chưa đúng định dạng';
    }
}
