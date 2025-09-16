<?php

namespace App\Infrastructure\Adapter\Http;

use App\Application\Command\CommandBusInterface;
use App\Application\Command\Level\CreateLevelCommand;
use App\Application\Command\Level\DeleteLevelCommand;
use App\Application\Query\QueryBusInterface;
use App\Application\Query\Level\GetLevelByIdQuery;
use App\Application\Query\Level\GetLevelsQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

final class LevelController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly CommandBusInterface $commandBus,
    ) {}

    #[Route('/api/levels', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse($this->queryBus->execute(new GetLevelsQuery()));
    }

    #[Route('/api/levels/{id}', methods: ['GET'])]
    public function getOne(string $id): JsonResponse
    {
        return new JsonResponse($this->queryBus->execute(new GetLevelByIdQuery($id)));
    }

    #[Route('/api/levels/{id}', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        return new JsonResponse($this->commandBus->execute(new DeleteLevelCommand($id)));
    }

    #[Route('/api/levels', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateLevelCommand $command
    ): JsonResponse
    {
        return new JsonResponse($this->commandBus->execute($command));
    }
}
