<?php

namespace App\Enums;

enum CountryPhoneEnum: string
{
    case Russia = '+7';
    case USA = '+1';
    case UK = '+44';

    public static function fromPhone(string $phone): ?self
    {
        foreach (self::cases() as $countryCode) {
            if (str_starts_with($phone, $countryCode->value)) {
                return $countryCode;
            }
        }

        return null;
    }

    public function getRegEx(): string
    {
        return match ($this) {
            self::Russia => '/(^8|7|\+7)((\d{10})|(\s\(\d{3}\)\s\d{3}\s\d{2}\s\d{2}))/',
            self::USA => '/(\+?(\b1)?[\ .\/-]?((?(2)|(\b))|(\())\d{3}(?(?<=\(\d{3})\)|)[\ .\/-]?)?(?(1)|\b)\d{3}[\ .\/-]?\d{4}[\ ]?([xX][\ ]?\d{1,5})?\b/gm',
            self::UK => '/(^\+[0-9]{2}|^\+[0-9]{2}\(0\)|^\(\+[0-9]{2}\)\(0\)|^00[0-9]{2}|^0)([0-9]{9}$|[0-9\-\s]{10}$)',
        };
    }
}
