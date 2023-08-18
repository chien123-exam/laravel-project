<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateYoutbe implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.facebook([\/\w \.-]*)*\/?$/';

        if (! preg_match($regex, $value)) {
            $fail('Not format youtube');
        }
    }
}
