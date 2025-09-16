<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserRepositoryInterface
{
    public function loadUserByIdentifier(string $identifier): ?UserInterface;

    public function getByToken(string $token): User;

    public function getOneById(string $id): User;

    public function save(User $user): void;

    public function getList(): array;
}
