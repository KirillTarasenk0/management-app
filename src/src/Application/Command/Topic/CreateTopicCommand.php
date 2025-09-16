<?php

declare(strict_types=1);

namespace App\Application\Command\Topic;

use App\Application\Command\CommandInterface;

final readonly class CreateTopicCommand implements CommandInterface
{
    public function __construct(
        private string $name,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }
}