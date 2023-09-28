<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy;

use App\Core\MyPatients\Application\Allergy\FindAllAllergies\FindAllAllergiesCommandHandler;
use App\Core\MyPatients\Domain\Allergy\Exceptions\AllergyNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindAllAllergies extends Controller
{
    public function __construct(private readonly FindAllAllergiesCommandHandler $handler)
    {
    }

    /**
     * @throws AllergyNotFoundException
     */
    public function __invoke(): JsonResponse
    {
        $allergies = $this->handler->handle();
        return response()->json($allergies, Response::HTTP_OK);
    }
}
