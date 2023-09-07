<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Patient;


use App\Core\MyPatients\Application\Patient\CreatePatient\CreatePatientCommandHandler;
use App\Http\Controllers\Controller;
use App\Core\MyPatients\Application\Patient\CreatePatient\CreatePatientCommand;
use App\Http\Requests\StorePatientRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreatePatient extends Controller
{

    public function __construct(private readonly CreatePatientCommandHandler $handler)
    {
    }

    public function __invoke(StorePatientRequest $request): int|JsonResponse
    {
        if ($request->validated()) {
            $this->handler->handle(new CreatePatientCommand([
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
