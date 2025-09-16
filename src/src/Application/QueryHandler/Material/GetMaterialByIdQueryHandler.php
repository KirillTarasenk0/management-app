<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Material;

use App\Application\Dto\Factory\Material\MaterialDtoFactory;
use App\Application\Dto\Material\MaterialDto;
use App\Application\Query\Material\GetMaterialByIdQuery;
use App\Application\Query\QueryHandlerInterface;
use App\Domain\Repository\MaterialRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetMaterialByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private MaterialRepositoryInterface $materialRepository,
        private MaterialDtoFactory $materialDtoFactory,
    ) {}

    public function __invoke(GetMaterialByIdQuery $query): MaterialDto
    {
        return $this->materialDtoFactory->create(
            $this->materialRepository->getOneById($query->getId()),
        );
    }
}