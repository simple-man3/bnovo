<?php

namespace App\Rules;

use App\Enums\CountryPhoneEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Phone implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $countryPhone = CountryPhoneEnum::fromPhone($value);

        if (is_null($countryPhone)) {
            $fail('incorrect phone number');
        }

        if (!preg_match($countryPhone->getRegEx(), $value)) {
            $fail('incorrect phone number');
        }
    }
}
