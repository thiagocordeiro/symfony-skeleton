<?php declare(strict_types=1);

namespace App\Tests\Unit\User\Values;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Values\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testWhenGivenEmailIsInvalidThenThrowException(): void
    {
        $email = 'local@local';

        $this->expectException(InvalidEmailException::class);

        new Email($email);
    }

    public function testWhenGivenAValidEmailThenCreateValueObject(): void
    {
        $email = 'local@local.com';

        $object = new Email($email);

        $this->assertInstanceOf(Email::class, $object);
    }
}
