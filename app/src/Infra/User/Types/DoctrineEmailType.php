<?php declare(strict_types=1);

namespace App\Infra\User\Types;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Values\Email;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * phpcs:ignoreFile
 */
class DoctrineEmailType extends Type
{
    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return 'varchar';
    }

    /**
     * @param Email $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return (string) $value;
    }

    /**
     * @param string $value
     * @throws InvalidEmailException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): Email
    {
        return new Email($value);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'useremail';
    }
}
