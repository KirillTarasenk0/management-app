<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Topic;

interface TopicRepositoryInterface
{
    public function save(Topic $entity): void;

    public function remove(Topic $entity): void;

    public function getOneById(string $id): Topic;

    /**
     * @return array<Topic>
     */
    public function getList(): array;
}
