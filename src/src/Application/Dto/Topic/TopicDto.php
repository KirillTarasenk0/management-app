<?php

declare(strict_types=1);

namespace App\Application\Dto\Topic;

use JsonSerializable;

final readonly class TopicDto implements JsonSerializable
{
    public function __construct(
        private string $id,
        private string $name,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}