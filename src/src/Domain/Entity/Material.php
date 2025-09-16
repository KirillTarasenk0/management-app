<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Content;
use App\Domain\ValueObject\Name;
use App\Infrastructure\Repository\TopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopicRepository::class)]
class Material extends AbstractEntity
{
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'materials')]
    private Collection $users;

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function __construct(
        #[ORM\Column(type: 'name', length: 255)]
        private readonly ?Name $name = null,

        #[ORM\Column(type: 'content', length: 50000)]
        private readonly ?Content $content = null,

        #[ORM\ManyToOne(targetEntity: Topic::class, inversedBy: 'materials')]
        private readonly ?Topic $topic = null,

        #[ORM\ManyToOne(targetEntity: Level::class, inversedBy: 'materials')]
        private readonly ?Level $level = null,
    )
    {
        $this->users = new ArrayCollection();
    }

    public function getContent(): ?Content
    {
        return $this->content;
    }

    public function getTopic(): ?Topic
    {
        return $this->topic;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function getName(): ?Name
    {
        return $this->name;
    }

    public function assignUsers(array $users): void
    {
        $this->users = new ArrayCollection($users);
    }
}
