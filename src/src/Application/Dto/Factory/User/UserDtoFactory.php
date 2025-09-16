<?php

declare(strict_types=1);

namespace App\Application\Dto\Factory\User;

use App\Application\Dto\Factory\Level\LevelDtoFactory;
use App\Application\Dto\User\UserDto;
use App\Domain\Entity\User;

final readonly class UserDtoFactory
{
    public function __construct(
        private LevelDtoFactory $levelDtoFactory,
    ) {}

    public function create(User $user): UserDto
    {
        return new UserDto(
            (string)$user->getId(),
            $user->getEmail(),
            $user->getRole()?->value,
            $user->getLevel() === null? null : $this->levelDtoFactory->create($user->getLevel()),
        );
    }
}