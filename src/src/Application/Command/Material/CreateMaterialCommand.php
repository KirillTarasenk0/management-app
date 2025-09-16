<?php

declare(strict_types=1);

namespace App\Application\Command\Material;

use App\Application\Command\CommandInterface;

final readonly class CreateMaterialCommand implements CommandInterface
{
    public function __construct(
        private string $name,
        private string $content,
        private string $levelId,
        private string $topicId,
    ) {}

    public function getContent(): string
    {
        return $this->content;
    }

    public function getLevelId(): string
    {
        return $this->levelId;
    }

    public function getTopicId(): string
    {
        return $this->topicId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}