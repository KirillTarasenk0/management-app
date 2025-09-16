<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Level;
use App\Domain\Entity\Material;
use App\Domain\Entity\Topic;
use App\Domain\ValueObject\Content;
use App\Domain\ValueObject\Name;

final readonly class MaterialFactory
{
    public function create(
        string $name,
        string $content,
        Level $level,
        Topic $topic,
    ): Material
    {
        return new Material(new Name($name), new Content($content), $topic, $level);
    }
}