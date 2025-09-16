<?php

namespace App\Infrastructure\Adapter\Http;

use App\Application\Command\CommandBusInterface;
use App\Application\Command\Material\AssignMaterialCommand;
use App\Application\Command\Material\CreateMaterialCommand;
use App\Application\Command\Material\DeleteMaterialCommand;
use App\Application\Query\QueryBusInterface;
use App\Application\Query\Material\GetMaterialByIdQuery;
use App\Application\Query\Material\GetMaterialsQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

final class MaterialController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly CommandBusInterface $commandBus,
    ) {}

    #[Route('/api/materials', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse($this->queryBus->execute(new GetMaterialsQuery()));
    }

    #[Route('/api/materials/{id}', methods: ['GET'])]
    public function getOne(string $id): JsonResponse
    {
        return new JsonResponse($this->queryBus->execute(new GetMaterialByIdQuery($id)));
    }

    #[Route('/api/materials/{id}', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        return new JsonResponse($this->commandBus->execute(new DeleteMaterialCommand($id)));
    }

    #[Route('/api/materials', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateMaterialCommand $command
    ): JsonResponse
    {
        return new JsonResponse($this->commandBus->execute($command));
    }

    #[Route('/api/materials/{id}', methods: ['PATCH'])]
    public function patch(string $id, Request $request): JsonResponse
    {
        return new JsonResponse($this->commandBus->execute(new AssignMaterialCommand($id, $request->toArray()['users'])));
    }
}
