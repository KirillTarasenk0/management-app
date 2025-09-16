<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Material;

use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\Material\DeleteMaterialCommand;
use App\Domain\Repository\MaterialRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class DeleteMaterialCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private MaterialRepositoryInterface $materialRepository,
    ) {}

    public function __invoke(DeleteMaterialCommand $command): void
    {
        $this->materialRepository->remove(
            $this->materialRepository->getOneById($command->getId())
        );
    }
}