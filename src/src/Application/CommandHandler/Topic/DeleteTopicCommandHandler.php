<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Topic;

use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\Topic\DeleteTopicCommand;
use App\Domain\Repository\TopicRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class DeleteTopicCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TopicRepositoryInterface $topicRepository,
    ) {}

    public function __invoke(DeleteTopicCommand $command): void
    {
        $this->topicRepository->remove(
            $this->topicRepository->getOneById($command->getId())
        );
    }
}