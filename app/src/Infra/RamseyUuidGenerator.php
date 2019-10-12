<?php declare(strict_types=1);

namespace App\Infra;

use App\Domain\UuidGenerator;
use Ramsey\Uuid\Uuid;

class RamseyUuidGenerator implements UuidGenerator
{
    public function generate(): string
    {
        return Uuid::uuid1()->toString();
    }
}
