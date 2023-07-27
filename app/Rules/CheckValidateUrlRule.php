<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckValidateUrlRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        $url = str_replace(['ä', 'ö', 'ü'], ['ae', 'oe', 'ue'], $value);
        $isLocation = $value != 4;
        $isUrl = filter_var($url, FILTER_VALIDATE_URL);

        return $isLocation && $isUrl;
    }

    public function message()
    {
        return ':attribute đang không chính xác';
    }
}
