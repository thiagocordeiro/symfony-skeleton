<?php declare(strict_types=1);

namespace App\Framework\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class ExceptionListener
{
    private bool $debug;
    private LoggerInterface $logger;

    public function __construct(bool $debug, LoggerInterface $logger)
    {
        $this->debug = $debug;
        $this->logger = $logger;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getException();

        $data = [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => 'Internal Server Error',
        ];

        if ($exception instanceof HttpException) {
            $data = [
                'status' => $exception->getStatusCode(),
                'message' => $exception->getMessage(),
            ];
        }

        if ($this->debug) {
            $data['debug'] = $this->getExceptionDetails($exception);
        }

        $this->logExceptionIfNeeded($exception);

        $event->setResponse(new JsonResponse($data, $data['status']));
    }

    private function logExceptionIfNeeded(Throwable $exception): void
    {
        if ($exception instanceof HttpException) {
            return;
        }

        $this->logger->error('Unhandled Exception', [
            'exception' => json_encode($exception, JSON_PRETTY_PRINT),
        ]);
    }

    private function getExceptionDetails(?Throwable $exception): ?ErrorDetail
    {
        if (!$exception) {
            return null;
        }

        return new ErrorDetail(
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $this->getExceptionDetails($exception->getPrevious())
        );
    }
}
