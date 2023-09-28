<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy;

use App\Core\MyPatients\Application\Allergy\FindAllergyById\FindAllergyByIdCommand;
use App\Core\MyPatients\Application\Allergy\FindAllergyById\FindAllergyByIdCommandHandler;
use App\Core\MyPatients\Domain\Allergy\Exceptions\AllergyNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindAllergyById extends Controller
{
    public function __construct(private readonly FindAllergyByIdCommandHandler $handler){}

    /**
     * @throws AllergyNotFoundException
     */
    public function __invoke(int $id): JsonResponse
    {
        $allergy = $this->handler->handle(new FindAllergyByIdCommand($id));
        return response()->json($allergy, Response::HTTP_OK);
    }
}
