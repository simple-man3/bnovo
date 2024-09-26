<?php

namespace App\Services;

use App\Models\Guest;
use Illuminate\Support\Arr;

final class GuestService
{
    public function create(Guest $guest): Guest
    {
        $guest->save();

        return $guest->refresh();
    }

    public function fillFromRequest(array $data): Guest
    {
        return new Guest(Arr::only($data, Guest::FILLABLE));
    }
}
