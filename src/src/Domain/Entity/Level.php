<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Weight;
use App\Infrastructure\Repository\TopicRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TopicRepository::class)]
class Level extends AbstractEntity
{
    #[ORM\OneToMany(mappedBy: 'level', targetEntity: Material::class)]
    private Collection $materials;

    public function __construct(
        #[ORM\Column(type: 'name', length: 255)]
        private readonly ?Name $name = null,

        #[ORM\Column(type: 'weight')]
        private readonly ?Weight $weight = null,
    ) {}

    public function getWeight(): ?Weight
    {
        return $this->weight;
    }

    public function getName(): ?Name
    {
        return $this->name;
    }
}
