<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Level;

use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\Level\CreateLevelCommand;
use App\Domain\Factory\LevelFactory;
use App\Domain\Repository\LevelRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CreateLevelCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private LevelRepositoryInterface $levelRepository,
        private LevelFactory $levelFactory,
    ) {}

    public function __invoke(CreateLevelCommand $command): void
    {
        $topic = $this->levelFactory->create($command->getName(), $command->getWeight());

        $this->levelRepository->save($topic);
    }
}