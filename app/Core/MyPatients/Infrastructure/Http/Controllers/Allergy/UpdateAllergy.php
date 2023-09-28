<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy;

use App\Core\MyPatients\Application\Allergy\UpdateAllergy\UpdateAllergyCommand;
use App\Core\MyPatients\Application\Allergy\UpdateAllergy\UpdateAllergyCommandHandler;
use App\Core\MyPatients\Domain\Allergy\Exceptions\AllergyNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAllergyRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateAllergy extends Controller
{
    public function __construct(private readonly UpdateAllergyCommandHandler $handler)
    {

    }

    /**
     * @throws AllergyNotFoundException
     */
    public function __invoke(StoreAllergyRequest $request, int $id): JsonResponse
    {
        $this->handler->handle(new UpdateAllergyCommand([...$request->validated(), 'id' => $request->id]));
        return response()->json(null, Response::HTTP_CREATED);

    }
}
