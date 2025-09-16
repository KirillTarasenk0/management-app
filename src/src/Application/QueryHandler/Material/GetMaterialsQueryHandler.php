<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Material;

use App\Application\Dto\Factory\Material\MaterialDtoFactory;
use App\Application\Dto\Material\MaterialDto;
use App\Application\Query\Material\GetMaterialsQuery;
use App\Application\Query\QueryHandlerInterface;
use App\Domain\Entity\Material;
use App\Domain\Repository\MaterialRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetMaterialsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private MaterialRepositoryInterface $materialRepository,
        private MaterialDtoFactory $materialDtoFactory,
    ) {}

    /**
     * @param GetMaterialsQuery $query
     * @return MaterialDto[]
     */
    public function __invoke(GetMaterialsQuery $query): array
    {
        $materials = $this->materialRepository->getList();

        return array_map(fn(Material $material) => $this->materialDtoFactory->create($material), $materials);
    }
}