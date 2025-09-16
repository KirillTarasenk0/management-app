<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Level;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Weight;

final readonly class LevelFactory
{
    public function create(string $name, int $weight): Level
    {
        return new Level(new Name($name), new Weight($weight));
    }
}