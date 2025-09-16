<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Level;

use App\Application\Dto\Factory\Level\LevelDtoFactory;
use App\Application\Dto\Level\LevelDto;
use App\Application\Query\Level\GetLevelsQuery;
use App\Application\Query\QueryHandlerInterface;
use App\Domain\Entity\Level;
use App\Domain\Repository\LevelRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetLevelsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private LevelRepositoryInterface $levelRepository,
        private LevelDtoFactory $levelDtoFactory,
    ) {}

    /**
     * @param GetLevelsQuery $query
     * @return LevelDto[]
     */
    public function __invoke(GetLevelsQuery $query): array
    {
        $Levels = $this->levelRepository->getList();

        return array_map(fn(Level $Level) => $this->levelDtoFactory->create($Level), $Levels);
    }
}