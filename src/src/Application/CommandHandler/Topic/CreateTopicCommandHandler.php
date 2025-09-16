<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Topic;

use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\Topic\CreateTopicCommand;
use App\Domain\Factory\TopicFactory;
use App\Domain\Repository\TopicRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CreateTopicCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TopicRepositoryInterface $topicRepository,
        private TopicFactory $topicFactory,
    ) {}

    public function __invoke(CreateTopicCommand $command): void
    {
        $topic = $this->topicFactory->create($command->getName());

        $this->topicRepository->save($topic);
    }
}