<?php
namespace App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation;

use App\Core\MyPatients\Application\Consultation\FindAllConsultations\FindAllConsultationsCommandHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FindAllConsultations extends Controller
{

    public function __construct(private readonly FindAllConsultationsCommandHandler $handler)
    {
    }

    public function __invoke(): JsonResponse
    {
        $specialities = $this->handler->handle();

        if (is_null($specialities)) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json($specialities, Response::HTTP_OK);
    }
}
