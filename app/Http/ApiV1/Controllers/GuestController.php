<?php

namespace App\Http\ApiV1\Controllers;

use App\Http\ApiV1\Requests\CreateGuestRequest;
use App\Http\ApiV1\Requests\UpdateGuestRequest;
use App\Http\ApiV1\Resources\GuestResource;
use App\Services\GuestService;
use Symfony\Component\HttpFoundation\Response;

class GuestController
{
    public function get(GuestService $service, int $id): GuestResource
    {
        return new GuestResource($service->findById($id));
    }

    public function create(CreateGuestRequest $request, GuestService $service): GuestResource
    {
        $model = $service->fillFromRequest($request->validated());

        return new GuestResource($service->create($model));
    }

    public function patch(UpdateGuestRequest $request, GuestService $service, int $id): GuestResource
    {
        $service->update($service->fillFromRequest($request->validated()), $id);

        return new GuestResource($service->findById($id));
    }

    public function delete(GuestService $service, int $id): Response
    {
        $service->delete($id);

        return response()->json(['data' => null]);
    }
}
