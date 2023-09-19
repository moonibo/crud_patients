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

    public function __invoke(int $id): JsonResponse
    {
        $record = $this->handler->handle(new FindRecordByIdCommand($id));
        return response()->json($record, Response::HTTP_OK);
    }
}
