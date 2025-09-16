<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Exception\AssessmentDateIsLessThanRecommendedException;
use App\Domain\ValueObject\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: '`user`')]
class User extends AbstractEntity
{
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', nullable: true, enumType: Role::class)]
    private ?Role $role = Role::EMPLOYEE;

    #[Orm\OneToMany(mappedBy: 'assignee', targetEntity: Assessment::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $assessments;

    #[ORM\ManyToOne(targetEntity: Level::class)]
    private ?Level $level = null;

    #[ORM\ManyToMany(targetEntity: Material::class, mappedBy: 'users')]
    private Collection $materials;

    public function __construct()
    {
        $this->assessments = new ArrayCollection();
        $this->materials = new ArrayCollection();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    public function setRole(Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function assignAssessment(Assessment $assessment): self
    {
        $existingAssessments = $this->assessments->toArray();

        usort(
            $existingAssessments,
            function (Assessment $firstAssessment, Assessment $secondAssessment) {
                return $firstAssessment->getDate() <=> $secondAssessment->getDate();
            },
        );
        $assessment->setPreviousLevel($this->getLevel());

        $lastAssessment = array_pop($existingAssessments);

        if (null === $lastAssessment) {
            $this->assessments->add($assessment);

            return $this;
        }

        if ($assessment->getDate() < $lastAssessment->getNextAssessmentDate()) {
            throw new AssessmentDateIsLessThanRecommendedException();
        }

        $this->assessments->add($assessment);

        return $this;
    }

    public function assignNewLevel(Level $level): void
    {
        $this->level = $level;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function getAssessments(): Collection
    {
        return $this->assessments;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }
}
