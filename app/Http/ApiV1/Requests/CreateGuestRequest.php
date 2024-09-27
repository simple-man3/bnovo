<?php

namespace App\Http\ApiV1\Requests;

use App\Enums\CountryEnum;
use App\Enums\CountryPhoneEnum;
use App\Models\Guest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class CreateGuestRequest extends FormRequest
{
    private string $countryCode;

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
                Rule::unique(Guest::class, 'phone'),
                function (string $attribute, string $value, callable $fail) {
                    $countryPhone = CountryPhoneEnum::fromPhone($value);

                    if (is_null($countryPhone)) {
                        return $fail('incorrect phone number');
                    }

                    if (!preg_match($countryPhone->getRegEx(), $value)) {
                        return $fail('incorrect phone number');
                    }

                    $this->countryCode = $countryPhone->getCode()->value;
                }
            ],
            'country' => ['nullable', Rule::enum(CountryEnum::class)],
        ];
    }

    #[Override]
    public function validated($key = null, $default = null): array
    {
        $body = parent::validated();

        if (!isset($body['country']) || $this->countryCode !== $body['country']) {
            $body['country'] = CountryPhoneEnum::fromPhone($body['phone'])->getCode();
        }

        return $body;
    }
}
