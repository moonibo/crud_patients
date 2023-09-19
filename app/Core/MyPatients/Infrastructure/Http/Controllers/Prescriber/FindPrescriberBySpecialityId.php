<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber;

use App\Core\MyPatients\Application\Prescriber\FindPrescriberBySpecialityId\FindPrescriberBySpecialityIdCommand;
use App\Core\MyPatients\Application\Prescriber\FindPrescriberBySpecialityId\FindPrescriberBySpecialityIdCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindPrescriberBySpecialityId extends Controller
{
    public function __construct(private readonly FindPrescriberBySpecialityIdCommandHandler $handler)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $prescribers = $this->handler->handle(New FindPrescriberBySpecialityIdCommand($id));
        return response()->json($prescribers,Response::HTTP_OK);
    }
}
