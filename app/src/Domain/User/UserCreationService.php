<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\InvalidNameException;
use App\Domain\User\Exception\UnableToSaveUserException;
use App\Domain\User\Values\Email;
use App\Domain\UuidGenerator;

class UserCreationService
{
    private UserCreator $creator;
    private UuidGenerator $uuid;

    public function __construct(UserCreator $creator, UuidGenerator $uuid)
    {
        $this->creator = $creator;
        $this->uuid = $uuid;
    }

    /**
     * @throws UnableToSaveUserException
     * @throws InvalidEmailException
     * @throws InvalidNameException
     */
    public function create(string $name, string $email): string
    {
        if (!$name) {
            throw new InvalidNameException();
        }

        $uuid = $this->uuid->generate();

        $this->creator->create(new User($uuid, $name, new Email($email)));

        return $uuid;
    }
}
