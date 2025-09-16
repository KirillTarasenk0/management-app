<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Level;

interface LevelRepositoryInterface
{
    public function save(Level $entity): void;

    public function remove(Level $entity): void;

    public function getOneById(string $id): Level;

    /**
     * @return array<Level>
     */
    public function getList(): array;
}
