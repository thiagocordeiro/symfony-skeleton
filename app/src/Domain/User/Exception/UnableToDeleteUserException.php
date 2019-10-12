<?php declare(strict_types=1);

namespace App\Domain\User\Exception;

use App\Domain\ApplicationDomainException;
use Throwable;

class UnableToDeleteUserException extends ApplicationDomainException
{
    public function __construct(Throwable $previous)
    {
        parent::__construct($previous);
    }
}
