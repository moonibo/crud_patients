<?php


namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality;


use App\Core\MyPatients\Application\Speciality\FindSpecialityById\FindSpecialityByIdCommand;
use App\Http\Controllers\Controller;
use App\Core\MyPatients\Application\Speciality\FindSpecialityById\FindSpecialityByIdCommandHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindSpecialityById extends Controller
{

    public function __construct(private readonly FindSpecialityByIdCommandHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $speciality = $this->handler->handle(new FindSpecialityByIdCommand($id));
        return response()->json($speciality, Response::HTTP_FOUND);
    }
}

