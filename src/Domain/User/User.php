<?php declare(strict_types=1);

namespace App\Domain\User;

class User
{
    private int $id;
    private string $email;
    private string $username;

    public function __construct(string $email, string $username)
    {
        $this->email = $email;
        $this->username = $username;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}
