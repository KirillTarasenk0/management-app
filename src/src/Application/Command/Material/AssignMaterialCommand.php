<?php

declare(strict_types=1);

namespace App\Application\Command\Material;

use App\Application\Command\CommandInterface;

final readonly class AssignMaterialCommand implements CommandInterface
{
    public function __construct(
        private string $id,
        private array $users,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsers(): array
    {
        return $this->users;
    }
}