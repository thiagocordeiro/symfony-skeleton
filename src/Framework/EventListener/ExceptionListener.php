<?php declare(strict_types=1);

namespace App\Framework\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getException();

        if (is_a($exception, HttpException::class)) {
            $event->setResponse(new JsonResponse([
                'message' => $exception->getMessage(),
            ]));

            return;
        }

        $event->setResponse(new JsonResponse([
            'message' => 'Internal Server Error',
        ], Response::HTTP_INTERNAL_SERVER_ERROR));
    }
}
