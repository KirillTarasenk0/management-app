<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Level;

use App\Application\Dto\Factory\Level\LevelDtoFactory;
use App\Application\Dto\Level\LevelDto;
use App\Application\Query\Level\GetLevelByIdQuery;
use App\Application\Query\QueryHandlerInterface;
use App\Domain\Repository\LevelRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetLevelByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private LevelRepositoryInterface $levelRepository,
        private LevelDtoFactory $levelDtoFactory,
    ) {}

    public function __invoke(GetLevelByIdQuery $query): LevelDto
    {
        return $this->levelDtoFactory->create(
            $this->levelRepository->getOneById($query->getId()),
        );
    }
}