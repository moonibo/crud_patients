<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Record;

use App\Core\MyPatients\Application\Record\CreateRecord\CreateRecordCommand;
use App\Core\MyPatients\Application\Record\CreateRecord\CreateRecordCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecordRequest;
use Symfony\Component\HttpFoundation\Response;

class CreateRecord extends Controller
{
    public function __construct(private readonly CreateRecordCommandHandler $handler){}

    public function __invoke(StoreRecordRequest $request)
    {
        if ($request->validated()) {
            $this->handler->handle(New CreateRecordCommand([
                'prescriber_id' => $request->prescriber_id,
                'patient_id' => $request->patient_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]));

            return response()->json(null, Response::HTTP_CREATED);
        }
        return response()->json(null, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
