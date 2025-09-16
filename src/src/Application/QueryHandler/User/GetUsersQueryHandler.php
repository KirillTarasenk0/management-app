<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\User;

use App\Application\Dto\Factory\User\UserDtoFactory;
use App\Application\Dto\User\UserDto;
use App\Application\Query\QueryHandlerInterface;
use App\Application\Query\User\GetUsersQuery;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetUsersQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserDtoFactory $userDtoFactory,
    ) {}

    /**
     * @param GetUsersQuery $query
     * @return UserDto[]
     */
    public function __invoke(GetUsersQuery $query): array
    {
        $users = $this->userRepository->getList();

        return array_map(fn(User $user) => $this->userDtoFactory->create($user), $users);;
    }
}