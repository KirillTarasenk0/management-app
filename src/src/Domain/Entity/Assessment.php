<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Assessment extends AbstractEntity
{
    #[ORM\ManyToOne(targetEntity: Level::class)]
    private ?Level $newLevel = null;

    #[ORM\OneToOne(inversedBy: 'assessment', targetEntity: IndividualDevelopmentPlan::class, cascade: ['persist', 'remove'])]
    private ?IndividualDevelopmentPlan $individualDevelopmentPlan;

    #[ORM\ManyToOne(targetEntity: Level::class)]
    private ?Level $previousLevel;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeInterface $nextAssessmentDate;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'assessments')]
        private readonly User $assignee,

        #[ORM\Column(type: 'datetime_immutable')]
        private DateTimeInterface $date,

        #[ORM\ManyToMany(targetEntity: Topic::class, inversedBy: "assessments")]
        private Collection $topics,
    ) {}


    public function setNewLevel(Level $newLevel): void
    {
        $this->newLevel = $newLevel;
    }

    public function setPreviousLevel(?Level $previousLevel): void
    {
        $this->previousLevel = $previousLevel;
    }

    public function getNextAssessmentDate(): ?DateTimeInterface
    {
        return $this->nextAssessmentDate;
    }

    public function getPreviousLevel(): ?Level
    {
        return $this->previousLevel;
    }

    public function getTopics(): Collection
    {
        return $this->topics;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function getAssignee(): User
    {
        return $this->assignee;
    }

    public function getNewLevel(): ?Level
    {
        return $this->newLevel;
    }

    public function getIndividualDevelopmentPlan(): ?IndividualDevelopmentPlan
    {
        return $this->individualDevelopmentPlan;
    }

    public function finishAssessment(
        Level $level,
        DateTimeInterface $nextAssessmentDate,
    ): void
    {
        $this->newLevel = $level;
        $this->nextAssessmentDate = $nextAssessmentDate;
    }

    public function assignIndividualDevelopmentPlan(IndividualDevelopmentPlan $individualDevelopmentPlan): void
    {
        $this->individualDevelopmentPlan = $individualDevelopmentPlan;
    }
}
