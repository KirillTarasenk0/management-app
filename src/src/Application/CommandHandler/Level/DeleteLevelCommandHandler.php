<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Level;

use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\Level\DeleteLevelCommand;
use App\Domain\Repository\LevelRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class DeleteLevelCommandHandler  implements CommandHandlerInterface
{
    public function __construct(
        private LevelRepositoryInterface $levelRepository,
    ) {}

    public function __invoke(DeleteLevelCommand $command): void
    {
        $this->levelRepository->remove(
            $this->levelRepository->getOneById($command->getId())
        );
    }
}