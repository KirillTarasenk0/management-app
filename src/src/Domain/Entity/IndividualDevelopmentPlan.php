<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Recommendation;
use App\Domain\ValueObject\Result;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class IndividualDevelopmentPlan extends AbstractEntity
{
    public function __construct(
        #[ORM\OneToOne(mappedBy: 'individualDevelopmentPlan', targetEntity: Assessment::class)]
        private readonly Assessment $assessment,

        #[ORM\Column(type: 'recommendation')]
        private readonly Recommendation $recommendation,

        #[ORM\Column(type: 'result')]
        private readonly Result $result,
    ) {}

    public function getAssessment(): Assessment
    {
        return $this->assessment;
    }

    public function getResult(): Result
    {
        return $this->result;
    }

    public function getRecommendation(): Recommendation
    {
        return $this->recommendation;
    }
}