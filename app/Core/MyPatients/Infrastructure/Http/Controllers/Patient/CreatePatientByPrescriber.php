<?php

class CreatePatientByPrescriber extends \App\Http\Controllers\Controller
{
    public function __construct(CreatePatientByPrescriberCommandHandler $handler)
    {

    }

    public function __invoke(int $id)
    {
        $response = $this->handler->handle(new CreatePatientByPrescriberCommand([
            'first_name' => ''
        ]));

        return response()->json($response);
    }
}
