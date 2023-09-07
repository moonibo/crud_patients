<?php
namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Patient;


use App\Core\MyPatients\Application\Patient\DeletePatient\DeletePatientCommand;
use App\Http\Controllers\Controller;
use App\Core\MyPatients\Application\Patient\DeletePatient\DeletePatientCommandHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePatient extends Controller
{

    public function __construct(private readonly DeletePatientCommandHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $deleted = $this->handler->handle(New DeletePatientCommand($id));

        if(!$deleted) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json(Response::HTTP_OK);
    }
}
