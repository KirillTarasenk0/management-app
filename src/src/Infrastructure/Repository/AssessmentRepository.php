<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Assessment;
use App\Domain\Entity\User;
use App\Domain\Exception\AssessmentNotFoundException;
use App\Domain\Repository\AssessmentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Assessment>
 *
 * @method Assessment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assessment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assessment[]    findAll()
 * @method Assessment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssessmentRepository extends ServiceEntityRepository implements AssessmentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assessment::class);
    }

    public function save(Assessment $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(Assessment $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function getOneById(string $id): Assessment
    {
        $assessment = $this->findOneBy(['id' => $id]);

        if (null === $assessment) {
            throw new AssessmentNotFoundException();
        }

        return $assessment;
    }

    public function getList(): array
    {
        return $this->findAll();
    }

    public function getByUser(User $user): array
    {
        $assessment = $this->findBy(['assignee' => $user]);

        return $assessment;
    }
}
