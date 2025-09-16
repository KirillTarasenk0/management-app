<?php

declare(strict_types=1);

namespace App\Application\Dto\Material;

use App\Application\Dto\Level\LevelDto;
use App\Application\Dto\Topic\TopicDto;
use JsonSerializable;

final readonly class MaterialDto implements JsonSerializable
{
    public function __construct(
        private string $id,
        private string $name,
        private string $content,
        private LevelDto $level,
        private TopicDto $topic,
        private array $users,
    ) {}

    public function getUsers(): array
    {
        return $this->users;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getLevel(): LevelDto
    {
        return $this->level;
    }

    public function getTopic(): TopicDto
    {
        return $this->topic;
    }


    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
            'level' => $this->level,
            'topic' => $this->topic,
            'users' => $this->users,
        ];
    }
}