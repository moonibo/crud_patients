<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Record;

use App\Core\MyPatients\Application\Record\FindRecordByPrescriberId\FindRecordByPrescriberCommandHandler;
use App\Core\MyPatients\Application\Record\FindRecordByPrescriberId\FindRecordByPrescriberIdCommand;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindRecordByPrescriberId extends Controller
{
    public function __construct(private readonly FindRecordByPrescriberCommandHandler $handler)
    {
    }

    public function __invoke(int $prescriberId): JsonResponse
    {
        $records = $this->handler->handle(new FindRecordByPrescriberIdCommand($prescriberId));

        if($records->isEmpty()) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        return response()->json($records, Response::HTTP_OK);
    }
}
