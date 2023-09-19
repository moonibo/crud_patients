<?php

namespace App\Core\MyPatients\Infrastructure\Http\Controllers\RegisteredPrescriber;

use App\Core\MyPatients\Application\RegisteredPrescriber\RegisteredPrescriberCommand;
use App\Core\MyPatients\Application\RegisteredPrescriber\RegisteredPrescriberCommandHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPrescriberRequest;
use App\Http\Requests\RegisterPrescriberRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AuthPrescriber extends Controller
{
    public function __construct(private readonly RegisteredPrescriberCommandHandler $handler)
    {}

    public function register (RegisterPrescriberRequest $request): JsonResponse
    {
        $prescriber = $this->handler->findPrescriberById($request->validated()['prescriber_id']);

        if($prescriber) {
            //$password = Hash::make($request->password);
            $this->handler->handle(new RegisteredPrescriberCommand($request->validated())); //->createToken('Register token')->accessToken;
            return response()->json(null, Response::HTTP_OK);
        }
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function logout (): JsonResponse
    {
        auth()->user()->token()->revoke();
        return response()->json('Logged out', Response::HTTP_OK);
    }
}
