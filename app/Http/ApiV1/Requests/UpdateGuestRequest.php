<?php

namespace App\Http\ApiV1\Requests;

use App\Enums\CountryEnum;
use App\Enums\CountryPhoneEnum;
use App\Rules\Email;
use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGuestRequest extends FormRequest
{
    public function rules(): array
    {
        $countryInBody = !is_null($this->request->get('country'));

        return [
            'first_name' => ['nullable'],
            'last_name' => ['nullable'],
            'email' => ['nullable', 'email', new Email()],
            'phone' => [Rule::RequiredIf($countryInBody), new Phone()],
            'country' => ['nullable', Rule::enum(CountryEnum::class)],
        ];
    }

    #[Override]
    public function validated($key = null, $default = null): array
    {
        $body = parent::validated();

        $phoneCountry = isset($body['phone'])
            ? CountryPhoneEnum::fromPhone($body['phone'])->getCode()->value
            : '';

        if (isset($body['country']) && $phoneCountry !== $body['country']) {
            $body['country'] = $phoneCountry;
        }

        return $body;
    }
}
