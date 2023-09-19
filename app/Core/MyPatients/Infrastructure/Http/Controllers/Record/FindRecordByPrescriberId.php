<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Record;

use App\Core\MyPatients\Application\Record\FindRecordByPrescriberId\FindRecordByPrescriberIdCommandHandler;
use App\Core\MyPatients\Application\Record\FindRecordByPrescriberId\FindRecordByPrescriberIdCommand;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindRecordByPrescriberId extends Controller
{
    public function __construct(private readonly FindRecordByPrescriberIdCommandHandler $handler)
    {
    }

    public function __invoke(int $prescriberId): JsonResponse
    {
        $records = $this->handler->handle(new FindRecordByPrescriberIdCommand($prescriberId));
        return response()->json($records, Response::HTTP_OK);
    }
}
