<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy;

use App\Core\MyPatients\Application\Allergy\CreateAllergy\CreateAllergyCommand;
use App\Core\MyPatients\Application\Allergy\CreateAllergy\CreateAllergyCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAllergyRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateAllergy extends Controller
{
    public function __construct(private readonly CreateAllergyCommandHandler $handler)
    {}

    public function __invoke(StoreAllergyRequest $request): JsonResponse
    {
        $this->handler->handle(new CreateAllergyCommand($request->validated()));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
