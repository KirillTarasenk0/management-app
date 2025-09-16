<?php

declare(strict_types=1);

namespace App\Application\Command\Topic;

use App\Application\Command\CommandInterface;

final readonly class DeleteTopicCommand implements CommandInterface
{
    public function __construct(
        private string $id,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }
}