<?php

namespace App\Http\ApiV1\Controllers;

use App\Http\ApiV1\Requests\CreateGuestRequest;
use App\Http\ApiV1\Resources\GuestResource;
use App\Services\GuestService;

class GuestController
{
    public function get()
    {
        //
    }

    public function create(CreateGuestRequest $request, GuestService $service): GuestResource
    {
        $model = $service->fillFromRequest($request->validated());

        return new GuestResource($service->create($model));
    }

    public function patch(string $id)
    {
        //
    }

    public function delete(string $id)
    {
        //
    }
}
