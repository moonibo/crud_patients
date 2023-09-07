<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber;

use App\Core\MyPatients\Application\Prescriber\FindAllPrescribers\FindAllPrescribersCommandHandler;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class FindAllPrescribers extends Controller
{
    public function __construct(private readonly FindAllPrescribersCommandHandler $handler){}

    public function __invoke()
    {
        $prescribers = $this->handler->handle();

        if (is_null($prescribers)) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        return response()->json($prescribers, Response::HTTP_OK);
    }
}
