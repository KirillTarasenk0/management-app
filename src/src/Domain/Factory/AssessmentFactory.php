<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Assessment;
use App\Domain\Entity\User;
use App\Domain\Exception\AssessmentDateIsLessThanCurrentException;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Clock\ClockInterface;

final readonly class AssessmentFactory
{
    public function __construct(
        private ClockInterface $clock
    ) {
    }

    public function create(User $user, array $topics, \DateTimeInterface $date): Assessment
    {
        if ($date < new $this->clock->now()) {
            throw new AssessmentDateIsLessThanCurrentException();
        }

        return new Assessment(
            $user,
            $date,
            new ArrayCollection($topics),
        );
    }
}