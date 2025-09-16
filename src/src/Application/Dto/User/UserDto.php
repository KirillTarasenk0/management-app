<?php

declare(strict_types=1);

namespace App\Application\Dto\User;

use App\Application\Dto\Level\LevelDto;
use JsonSerializable;

final readonly class UserDto implements JsonSerializable
{
    public function __construct(
        private string $id,
        private string $email,
        private ?string $role,
        private ?LevelDto $level,
    ) {}

    public function getLevel(): LevelDto
    {
        return $this->level;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'role' => $this->role,
            'level' => $this->level,
        ];
    }
}