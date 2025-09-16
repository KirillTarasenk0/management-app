<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\User;

use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\User\UpdateRoleCommand;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\Role;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class UpdateRoleCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {}

    public function __invoke(UpdateRoleCommand $command): void
    {
        $user = $this->userRepository->getOneById($command->getUserId());

        $user->setRole(Role::tryFrom($command->getRole()));

        $this->userRepository->save($user);
    }
}