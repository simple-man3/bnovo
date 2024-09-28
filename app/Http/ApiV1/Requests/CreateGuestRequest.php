<?php

namespace App\Http\ApiV1\Requests;

use App\Enums\CountryEnum;
use App\Enums\CountryPhoneEnum;
use App\Models\Guest;
use App\Rules\Email;
use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class CreateGuestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', new Email()],
            'phone' => ['required', Rule::unique(Guest::class, 'phone'), new Phone()],
            'country' => ['nullable', Rule::enum(CountryEnum::class)],
        ];
    }

    #[Override]
    public function validated($key = null, $default = null): array
    {
        $body = parent::validated();

        $phoneCountry = CountryPhoneEnum::fromPhone($body['phone'])->getCode()->value;

        if (!isset($body['country']) || $phoneCountry !== $body['country']) {
            $body['country'] = $phoneCountry;
        }

        return $body;
    }
}
