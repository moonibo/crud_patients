<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Core\MyPatients\Application\Record\FindAllRecords\FindAllRecordsCommandHandler;

class FindAllRecords extends Controller
{
    public function __construct(private readonly FindAllRecordsCommandHandler $handler)
    {
    }

    public function __invoke(): JsonResponse|int
    {
        $records = $this->handler->handle();

        if (is_null($records)) {
            return Response::HTTP_NO_CONTENT;
        }

        return response()->json($records, Response::HTTP_OK);
    }
}
