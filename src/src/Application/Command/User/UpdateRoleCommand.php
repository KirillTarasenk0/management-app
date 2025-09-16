<?php

declare(strict_types=1);

namespace App\Application\Command\User;

use App\Application\Command\CommandInterface;

final readonly class UpdateRoleCommand implements CommandInterface
{
    public function __construct(
        private string $role,
        private string $userId,
    ) {}

    public function getRole(): string
    {
        return $this->role;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}