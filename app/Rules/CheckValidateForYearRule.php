<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckValidateForYearRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        $isLocation = $value != 4;
        $isNumber = is_numeric($value);
        $isMin = $value > 1;

        return $isLocation && $isNumber && $isMin;
    }

    public function message()
    {
        return ':attribute không chính xác';
    }
}
