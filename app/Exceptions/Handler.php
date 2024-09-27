<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler
{
    public function handle(Throwable $e, Request $request): Response
    {
        if ($request->is('api/*')) {
            if ($e instanceof ValidationException) {
                return $this->validationExceptionToResponse($e);
            }

            return response()->json($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->withException($e);
    }

    protected function validationExceptionToResponse(ValidationException $e): Response
    {
        if ($e->response) {
            return $e->response;
        }

        $errors = collect($e->validator->errors()->toArray())
            ->flatten()
            ->map(function (string $message) {
                return [
                    "code" => "ValidationError",
                    "message" => $message,
                ];
            })
            ->values()
            ->toArray();

        return response()->json($this->formatErrorPayload($errors), 400);
    }

    private function formatErrorPayload(array $errorData): array
    {
        return [
            'data' => null,
            'errors' => $errorData,
        ];
    }
}
