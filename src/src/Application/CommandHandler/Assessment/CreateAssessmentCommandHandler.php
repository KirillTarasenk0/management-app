<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Assessment;

use App\Application\Command\Assessment\CreateAssessmentCommand;
use App\Application\Command\CommandHandlerInterface;
use App\Domain\Factory\AssessmentFactory;
use App\Domain\Repository\TopicRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CreateAssessmentCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private AssessmentFactory $assessmentFactory,
        private TopicRepositoryInterface $topicRepository,
        private UserRepositoryInterface $userRepository,
    ) {}

    public function __invoke(CreateAssessmentCommand $command): void
    {
        $topics = [];

        foreach ($command->getTopicsId() as $topicId) {
            $topics[] = $this->topicRepository->getOneById($topicId);
        }

        $user = $this->userRepository->getOneById($command->getAssigneeId());

        $assessment = $this->assessmentFactory->create(
            $user,
            $topics,
            $command->getDate(),
        );

        $user->assignAssessment($assessment);

        $this->userRepository->save($user);
    }
}