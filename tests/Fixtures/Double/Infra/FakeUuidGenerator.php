<?php declare(strict_types=1);

namespace App\Tests\Fixtures\Double\Infra;

use App\Domain\UuidGenerator;

class FakeUuidGenerator implements UuidGenerator
{
    public function generate(): string
    {
        return 'c6a122d6-827c-428a-9dfd-048f39c6d7e6';
    }
}
