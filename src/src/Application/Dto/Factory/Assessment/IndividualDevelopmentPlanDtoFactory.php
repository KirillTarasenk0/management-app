<?php

declare(strict_types=1);

namespace App\Application\Dto\Factory\Assessment;

use App\Application\Dto\Assessment\IndividualDevelopmentPlanDto;
use App\Domain\Entity\IndividualDevelopmentPlan;

final readonly class IndividualDevelopmentPlanDtoFactory
{
    public function create(IndividualDevelopmentPlan $individualDevelopmentPlan): IndividualDevelopmentPlanDto
    {
        return new IndividualDevelopmentPlanDto(
            (string)$individualDevelopmentPlan->getId(),
            (string)$individualDevelopmentPlan->getRecommendation(),
            (string)$individualDevelopmentPlan->getResult(),
        );
    }
}