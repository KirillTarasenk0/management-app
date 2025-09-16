<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Name;
use App\Infrastructure\Repository\TopicRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopicRepository::class)]
class Topic extends AbstractEntity
{
    #[ORM\OneToMany(mappedBy: 'topic', targetEntity: Material::class)]
    private Collection $materials;

    #[ORM\ManyToMany(targetEntity: Assessment::class, mappedBy: 'topics')]
    private Collection $assessments;

    public function __construct(
        #[ORM\Column(type: 'name', length: 255)]
        private readonly ?Name $name = null,
    ) {}

    public function getName(): ?Name
    {
        return $this->name;
    }
}
