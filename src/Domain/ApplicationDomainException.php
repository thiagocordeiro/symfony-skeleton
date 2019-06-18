<?php declare(strict_types=1);

namespace App\Domain;

use Exception;
use Throwable;

abstract class ApplicationDomainException extends Exception
{
    public function __construct(?Throwable $previous = null)
    {
        $className = explode('\\', static::class);
        $className = end($className);
        $className = str_replace('Exception', '', $className);
        $message = preg_replace('/(?<!^)([A-Z])/', ' $1', $className);

        parent::__construct($message, 0, $previous);
    }
}
