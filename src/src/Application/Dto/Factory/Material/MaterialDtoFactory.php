<?php

declare(strict_types=1);

namespace App\Application\Dto\Factory\Material;

use App\Application\Dto\Factory\Level\LevelDtoFactory;
use App\Application\Dto\Factory\Topic\TopicDtoFactory;
use App\Application\Dto\Factory\User\UserDtoFactory;
use App\Application\Dto\Material\MaterialDto;
use App\Domain\Entity\Material;
use App\Domain\Entity\User;

final readonly class MaterialDtoFactory
{
    public function __construct(
        private LevelDtoFactory $levelDtoFactory,
        private TopicDtoFactory $topicDtoFactory,
        private UserDtoFactory $userDtoFactory,
    ) {}

    public function create(Material $material): MaterialDto
    {
        return new MaterialDto(
            (string)$material->getId(),
            (string)$material->getName(),
            (string)$material->getContent(),
            $this->levelDtoFactory->create($material->getLevel()),
            $this->topicDtoFactory->create($material->getTopic()),
            array_map(fn(User $user) => $this->userDtoFactory->create($user), $material->getUsers()->toArray()),
        );
    }
}