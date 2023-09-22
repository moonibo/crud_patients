<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Patient;


use App\Core\MyPatients\Application\Patient\UpdatePatient\UpdatePatientCommandHandler;
use App\Core\MyPatients\Domain\Patient\Exceptions\PatientNotFoundException;
use App\Core\MyPatients\Domain\Prescriber\Exceptions\PrescriberNotFoundException;
use App\Http\Controllers\Controller;
use App\Core\MyPatients\Application\Patient\UpdatePatient\UpdatePatientCommand;
use App\Http\Requests\StorePatientRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdatePatient extends Controller
{

    public function __construct(private readonly UpdatePatientCommandHandler $handler)
    {
    }

    /**
     * @throws PrescriberNotFoundException
     * @throws PatientNotFoundException
     */
    public function __invoke(StorePatientRequest $request, int $id): JsonResponse
    {
        $this->handler->handle(new UpdatePatientCommand([...$request->validated(), 'id' => $request->id]));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
