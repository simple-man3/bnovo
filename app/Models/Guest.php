<?php

namespace App\Models;

use App\Enums\CountryEnum;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Гости
 *
 * @property int $id - Идентификатор
 * @property string $first_name - Имя
 * @property string $last_name - Фамилия
 * @property string $email - Почта
 * @property string $phone - Телефон
 * @property CountryEnum $country - Страна
 * @property CarbonInterface $created_at - Дата и время создания записи
 * @property CarbonInterface $updated_at - Дата и время изменения записи
 */
class Guest extends Model
{
    /** @var string[] */
    public const array FILLABLE = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
    ];

    protected $fillable = self::FILLABLE;

    protected $casts = [
        'country' => CountryEnum::class,
    ];
}
