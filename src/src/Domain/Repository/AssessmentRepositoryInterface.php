<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Assessment;
use App\Domain\Entity\User;

interface AssessmentRepositoryInterface
{
    public function save(Assessment $entity): void;

    public function remove(Assessment $entity): void;

    public function getOneById(string $id): Assessment;

    /**
     * @return array<Assessment>
     */
    public function getList(): array;

    /**
     * @return array<Assessment>
     */
    public function getByUser(User $user): array;
}
