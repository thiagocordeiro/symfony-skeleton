<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\User\Values\Email;

class User
{
    private string $id;
    private string $name;
    private Email $email;

    public function __construct(string $id, string $name, Email $email)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
