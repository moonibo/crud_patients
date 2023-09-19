<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription;

use App\Core\MyPatients\Application\Prescription\UpdatePrescription\UpdatePrescriptionCommand;
use App\Core\MyPatients\Application\Prescription\UpdatePrescription\UpdatePrescriptionCommandHandler;
use App\Core\MyPatients\Domain\Prescription\Contracts\PrescriptionInterface;
use App\Core\MyPatients\Domain\Prescription\Services\PrescriptionFinder;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrescriptionRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdatePrescription extends Controller
{
    public function __construct(private readonly UpdatePrescriptionCommandHandler $handler){}

    public function __invoke(StorePrescriptionRequest $request, int $id): JsonResponse
    {
        $this->handler->handle(New UpdatePrescriptionCommand([...$request->validated(), 'id' => $request->id]));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
