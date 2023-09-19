<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Record;

use App\Core\MyPatients\Application\Record\FindRecordById\FindRecordByIdCommand;
use App\Core\MyPatients\Application\Record\FindRecordById\FindRecordByIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindRecordById extends Controller
{
    public function __construct(private readonly FindRecordByIdCommandHandler $handler)
    {}

    public function __invoke(int $id): JsonResponse|int
    {
        $record = $this->handler->handle(new FindRecordByIdCommand($id));
        if (is_null($record)) {
            return Response::HTTP_NO_CONTENT;
        }
        return response()->json($record, Response::HTTP_OK);
    }
}
