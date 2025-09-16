<?php

declare(strict_types=1);

namespace App\Application\Dto\Level;

final readonly class LevelDto implements \JsonSerializable
{
    public function __construct(
        private string $id,
        private string $name,
        private int $weight,
    ) {}

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'weight' => $this->weight,
        ];
    }
}