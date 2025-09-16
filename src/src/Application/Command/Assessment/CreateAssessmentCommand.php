<?php

declare(strict_types=1);

namespace App\Application\Command\Assessment;

use App\Application\Command\CommandInterface;
use DateTimeInterface;

final readonly class CreateAssessmentCommand implements CommandInterface
{
    public function __construct(
        private string $assigneeId,
        private DateTimeInterface $date,
        private array $topicsId,
    ) {}

    public function getAssigneeId(): string
    {
        return $this->assigneeId;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function getTopicsId(): array
    {
        return $this->topicsId;
    }
}