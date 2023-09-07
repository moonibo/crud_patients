<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Patient;


use App\Core\MyPatients\Application\Patient\UpdatePatient\UpdatePatientCommandHandler;
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

    public function __invoke(StorePatientRequest $request, int $id): JsonResponse
    {
        if ($request->validated()) {
            $this->handler->handle(new UpdatePatientCommand([
                'id' => $request->id,
                'name' => $request->name,
                'surname' => $request->surname,
                'mail' => $request->mail,
                'gender' => $request->gender,
                'prescriber_id' => $request->prescriber_id,
            ]));

            return response()->json(null, Response::HTTP_CREATED);
        }

        return response()->json(null, Response::HTTP_UNPROCESSABLE_ENTITY);

    }
}
