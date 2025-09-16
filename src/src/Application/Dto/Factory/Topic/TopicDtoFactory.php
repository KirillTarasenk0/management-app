<?php

declare(strict_types=1);

namespace App\Application\Dto\Factory\Topic;

use App\Application\Dto\Topic\TopicDto;
use App\Domain\Entity\Topic;

final readonly class TopicDtoFactory
{
    public function create(Topic $topic): TopicDto
    {
        return new TopicDto((string)$topic->getId(), (string)$topic->getName());
    }
}