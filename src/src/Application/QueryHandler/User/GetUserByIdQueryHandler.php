<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\User;

use App\Application\Dto\Factory\User\UserDtoFactory;
use App\Application\Dto\User\UserDto;
use App\Application\Query\QueryHandlerInterface;
use App\Application\Query\User\GetUserByIdQuery;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetUserByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserDtoFactory $userDtoFactory,
    ) {}

    public function __invoke(GetUserByIdQuery $query): UserDto
    {
        return $this->userDtoFactory->create(
            $this->userRepository->getOneById($query->getId()),
        );
    }
}