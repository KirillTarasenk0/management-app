<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Topic;
use App\Domain\ValueObject\Name;

final readonly class TopicFactory
{
    public function create(string $name): Topic
    {
        return new Topic(new Name($name));
    }
}