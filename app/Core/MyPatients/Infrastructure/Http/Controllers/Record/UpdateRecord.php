<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Record;

use App\Core\MyPatients\Application\Record\UpdateRecord\UpdateRecordCommand;
use App\Core\MyPatients\Application\Record\UpdateRecord\UpdateRecordCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecordRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRecord extends Controller
{
    public function __construct(private readonly UpdateRecordCommandHandler $handler){}

    public function __invoke(StoreRecordRequest $request, int $id)
    {
        if ($request->validated()) {
            $this->handler->handle(new UpdateRecordCommand([
                'id' => $request->id,
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
