<?php

declare(strict_types=1);

namespace App\Application\Command\Material;

use App\Application\Command\CommandInterface;

final readonly class DeleteMaterialCommand implements CommandInterface
{
    public function __construct(
        private string $id,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }
}