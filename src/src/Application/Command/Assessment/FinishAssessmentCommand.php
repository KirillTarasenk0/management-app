<?php

declare(strict_types=1);

namespace App\Application\Command\Assessment;

use App\Application\Command\CommandInterface;
use DateTimeInterface;

final readonly class FinishAssessmentCommand implements CommandInterface
{
    public function __construct(
        private DateTimeInterface $nextAssessmentDate,
        private string $assessmentId,
        private string $result,
        private string $recommendation,
        private string $levelId,
    ) {}

    public function getNextAssessmentDate(): DateTimeInterface
    {
        return $this->nextAssessmentDate;
    }

    public function getLevelId(): string
    {
        return $this->levelId;
    }

    public function getRecommendation(): string
    {
        return $this->recommendation;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function getAssessmentId(): string
    {
        return $this->assessmentId;
    }
}