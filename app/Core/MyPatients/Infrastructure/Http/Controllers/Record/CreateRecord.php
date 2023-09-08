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
        $this->handler->handle(New CreateRecordCommand($request->validated()));
        return response()->json(null, Response::HTTP_CREATED);
    }
}
