<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Material;

interface MaterialRepositoryInterface
{
    public function save(Material $entity): void;

    public function remove(Material $entity): void;

    public function getOneById(string $id): Material;

    /**
     * @return array<Material>
     */
    public function getList(): array;
}
