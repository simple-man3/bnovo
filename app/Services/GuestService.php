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

    public function findById(int $id): Guest
    {
        return Guest::query()->findOrFail($id);
    }

    public function update(Guest $guest, int $id): void
    {
        Guest::query()->where('id', $id)->update($guest->toArray());
    }

    public function delete(int $id): void
    {
        Guest::query()->where('id', $id)->delete();
    }
}
