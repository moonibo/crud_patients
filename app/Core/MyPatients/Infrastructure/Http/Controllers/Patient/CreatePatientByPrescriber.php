<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Patient;

use App\Core\MyPatients\Application\Patient\CreatePatientByPrescriber\CreatePatientByPrescriberCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Core\MyPatients\Application\Patient\CreatePatientByPrescriber\CreatePatientByPrescriberCommand;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreatePatientByPrescriber extends Controller
{
    public function __construct(private readonly CreatePatientByPrescriberCommandHandler $handler)
    {

    }

    public function __invoke(StorePatientRequest $request): JsonResponse
    {
        $this->handler->handle(new CreatePatientByPrescriberCommand([...$request->validated(), 'prescriber_id' => auth()->user()->prescriber->id]));

        return response()->json(null, Response::HTTP_OK);
    }
}
