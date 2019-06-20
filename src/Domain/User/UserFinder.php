<?php declare(strict_types=1);

namespace App\Domain\User;

interface UserFinder
{
    public function findById(string $id): ?User;
}
