<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Material;

use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\Material\CreateMaterialCommand;
use App\Domain\Factory\MaterialFactory;
use App\Domain\Repository\LevelRepositoryInterface;
use App\Domain\Repository\MaterialRepositoryInterface;
use App\Domain\Repository\TopicRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CreateMaterialCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private LevelRepositoryInterface $levelRepository,
        private MaterialRepositoryInterface $materialRepository,
        private TopicRepositoryInterface $topicRepository,
        private MaterialFactory $materialFactory,
    ) {}

    public function __invoke(CreateMaterialCommand $command): void
    {
        $topic = $this->topicRepository->getOneById($command->getTopicId());
        $level = $this->levelRepository->getOneById($command->getLevelId());

        $material = $this->materialFactory->create(
            $command->getName(),
            $command->getContent(),
            $level,
            $topic,
        );

        $this->materialRepository->save($material);
    }
}