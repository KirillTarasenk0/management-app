<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Assessment;
use App\Domain\Entity\IndividualDevelopmentPlan;
use App\Domain\ValueObject\Recommendation;
use App\Domain\ValueObject\Result;

final readonly class IndividualDevelopmentPlanFactory
{
    public function __construct() {}

    public static function create(
        Assessment $assessment,
        string $recommendation,
        string $result,
    ): IndividualDevelopmentPlan {
        return new IndividualDevelopmentPlan(
            $assessment,
            new Recommendation($recommendation),
            new Result($result),
        );
    }
}