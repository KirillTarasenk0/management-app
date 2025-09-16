<?php

declare(strict_types=1);

namespace App\Application\Dto\Factory\Assessment;

use App\Application\Dto\Assessment\AssessmentDto;
use App\Application\Dto\Factory\Level\LevelDtoFactory;
use App\Application\Dto\Factory\Topic\TopicDtoFactory;
use App\Application\Dto\Factory\User\UserDtoFactory;
use App\Domain\Entity\Assessment;

final readonly class AssessmentDtoFactory
{
    public function __construct(
        private TopicDtoFactory $topicDtoFactory,
        private UserDtoFactory $userDtoFactory,
        private IndividualDevelopmentPlanDtoFactory $individualDevelopmentPlanDtoFactory,
        private LevelDtoFactory $levelDtoFactory,
    ) {}

    public function create(
        Assessment $assessment,
    ): AssessmentDto
    {
        $topics = [];

        foreach ($assessment->getTopics() as $topic) {
            $topics[] = $this->topicDtoFactory->create($topic);
        }

        return new AssessmentDto(
            (string)$assessment->getId(),
            $this->userDtoFactory->create($assessment->getAssignee()),
            $topics,
            $assessment->getDate(),
            $assessment->getIndividualDevelopmentPlan() !== null
                ? $this->individualDevelopmentPlanDtoFactory->create($assessment->getIndividualDevelopmentPlan())
                : null,
            $assessment->getNextAssessmentDate(),
            $assessment->getPreviousLevel() !== null
                ? $this->levelDtoFactory->create($assessment->getPreviousLevel())
                : null,
            $assessment->getNewLevel() !== null
                ? $this->levelDtoFactory->create($assessment->getNewLevel()) : null,
        );
    }
}