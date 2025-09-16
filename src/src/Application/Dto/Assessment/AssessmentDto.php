<?php

declare(strict_types=1);

namespace App\Application\Dto\Assessment;

use App\Application\Dto\Level\LevelDto;
use App\Application\Dto\User\UserDto;
use DateTimeInterface;
use JsonSerializable;

final readonly class AssessmentDto implements JsonSerializable
{
    public function __construct(
        private string $id,
        private UserDto $assignee,
        private array $topics,
        private DateTimeInterface $date,
        private ?IndividualDevelopmentPlanDto $individualDevelopmentPlan,
        private ?DateTimeInterface $nextAssessmentDate,
        private ?LevelDto $previousLevel,
        private ?LevelDto $newLevel,
    ) {}

    public function getNextAssessmentDate(): DateTimeInterface
    {
        return $this->nextAssessmentDate;
    }

    public function getIndividualDevelopmentPlan(): IndividualDevelopmentPlanDto
    {
        return $this->individualDevelopmentPlan;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAssignee(): UserDto
    {
        return $this->assignee;
    }

    public function getTopics(): array
    {
        return $this->topics;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }


    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'assignee' => $this->assignee,
            'topics' => $this->topics,
            'date' => $this->date,
            'individualDevelopmentPlan' => $this->individualDevelopmentPlan,
            'nextAssessmentDate' => $this->nextAssessmentDate,
            'previousLevel' => $this->previousLevel,
            'newLevel' => $this->newLevel,
        ];
    }
}