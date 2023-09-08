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
        $this->handler->handle(new UpdateRecordCommand([...$request->validated(), 'id' => $request->id]));
        return response()->json(null, Response::HTTP_CREATED);

    }
}
