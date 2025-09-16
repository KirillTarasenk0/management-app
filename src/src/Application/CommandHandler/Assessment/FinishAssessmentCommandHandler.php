<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Assessment;

use App\Application\Command\Assessment\FinishAssessmentCommand;
use App\Application\Command\CommandHandlerInterface;
use App\Domain\Factory\IndividualDevelopmentPlanFactory;
use App\Domain\Repository\AssessmentRepositoryInterface;
use App\Domain\Repository\LevelRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
#[AsMessageHandler]
final readonly class FinishAssessmentCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private AssessmentRepositoryInterface $assessmentRepository,
        private UserRepositoryInterface $userRepository,
        private LevelRepositoryInterface $levelRepository,
        private IndividualDevelopmentPlanFactory $individualDevelopmentPlanFactory,
    ) {}

    public function __invoke(FinishAssessmentCommand $command): void
    {
        $level = $this->levelRepository->getOneById($command->getLevelId());

        $assessment = $this->assessmentRepository->getOneById($command->getAssessmentId());
        $assessment->finishAssessment($level, $command->getNextAssessmentDate());
        $assessment->assignIndividualDevelopmentPlan(
            $this->individualDevelopmentPlanFactory->create(
                $assessment,
                $command->getRecommendation(),
                $command->getResult(),
            ),
        );

        $user = $assessment->getAssignee();
        $user->assignNewLevel($level);
        $this->userRepository->save($user);

        $this->assessmentRepository->save($assessment);
    }
}