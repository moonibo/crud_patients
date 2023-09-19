<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Record;

use App\Core\MyPatients\Application\Record\DeleteRecord\DeleteRecordCommand;
use App\Core\MyPatients\Application\Record\DeleteRecord\DeleteRecordCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteRecord extends Controller
{
    public function __construct(private readonly DeleteRecordCommandHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $this->handler->handle(New DeleteRecordCommand($id));
        return response()->json(null, Response::HTTP_OK);
    }
}
