<?php

namespace App\Http\ApiV1\Requests;

use App\Enums\CountryEnum;
use App\Enums\CountryPhoneEnum;
use App\Models\Guest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateGuestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => [
                'required',
                'email',
                function (string $attribute, string $value, callable $fail) {
                    $emailExist = Guest::query()->where('email', strtolower($value))->exists();

                    if ($emailExist) {
                        $fail('This email is already exist');
                    }
                }
            ],
            'phone' => [
                'required',
                function (string $attribute, string $value, callable $fail) {
                    $countryPhone = CountryPhoneEnum::fromPhone($value);

                    if (is_null($countryPhone)) {
                        return $fail('incorrect phone number');
                    }

                    if (!preg_match($countryPhone->getRegEx(), $value)) {
                        return $fail('incorrect phone number');
                    }
                }
            ],
            'country' => ['nullable', Rule::enum(CountryEnum::class)],
        ];
    }
}
