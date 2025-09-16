<?php

declare(strict_types=1);

namespace App\Application\Dto\Assessment;

use JsonSerializable;

final readonly class IndividualDevelopmentPlanDto implements JsonSerializable
{
    public function __construct(
        private string $id,
        private string $recommendation,
        private string $result,
    ) {}

    public function getResult(): string
    {
        return $this->result;
    }

    public function getRecommendation(): string
    {
        return $this->recommendation;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'recommendation' => $this->recommendation,
            'result' => $this->result,
        ];
    }
}