<?php

declare(strict_types=1);

namespace App\Application\Dto\Factory\Level;

use App\Application\Dto\Level\LevelDto;
use App\Domain\Entity\Level;

final readonly class LevelDtoFactory
{
    public function create(Level $level): LevelDto
    {
        return new LevelDto((string)$level->getId(), (string)$level->getName(), $level->getWeight()->toValue());
    }
}