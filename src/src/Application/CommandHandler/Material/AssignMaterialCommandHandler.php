<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Material;

use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\Material\AssignMaterialCommand;
use App\Domain\Repository\MaterialRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class AssignMaterialCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private MaterialRepositoryInterface $materialRepository,
        private UserRepositoryInterface $userRepository,
    ) {}

    public function __invoke(AssignMaterialCommand $command): void
    {
        $material = $this->materialRepository->getOneById($command->getId());

        $users = [];
        foreach ($command->getUsers() as $userId) {
            $users[] = $this->userRepository->getOneById($userId);
        }

        $material->assignUsers($users);

        $this->materialRepository->save($material);
    }
}