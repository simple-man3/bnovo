<?php

namespace App\Rules;

use App\Models\Guest;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Email implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $emailExist = Guest::query()->where('email', strtolower($value))->exists();

        if ($emailExist) {
            $fail('This email is already exist');
        }
    }
}
