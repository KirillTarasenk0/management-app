<?php

declare(strict_types=1);

namespace App\Application\Command\Level;

use App\Application\Command\CommandInterface;

final readonly class CreateLevelCommand implements CommandInterface
{
    public function __construct(
        private string $name,
        private int $weight,
    ) {}

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getName(): string
    {
        return $this->name;
    }
}