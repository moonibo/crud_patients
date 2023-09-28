<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy;

use App\Core\MyPatients\Application\Allergy\DeleteAllergy\DeleteAllergyCommand;
use App\Core\MyPatients\Application\Allergy\DeleteAllergy\DeleteAllergyCommandHandler;
use App\Core\MyPatients\Domain\Allergy\Exceptions\AllergyNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteAllergy extends Controller
{
    public function __construct(private readonly DeleteAllergyCommandHandler $handler)
    {
    }

    /**
     * @throws AllergyNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        $this->handler->handle(new DeleteAllergyCommand($id));
        return response()->json(null, Response::HTTP_OK);
    }
}
