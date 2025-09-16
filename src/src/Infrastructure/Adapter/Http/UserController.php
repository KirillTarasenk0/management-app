<?php

namespace App\Infrastructure\Adapter\Http;

use App\Application\Command\CommandBusInterface;
use App\Application\Command\User\UpdateRoleCommand;
use App\Application\Query\QueryBusInterface;
use App\Application\Query\User\GetUserByIdQuery;
use App\Application\Query\User\GetUsersQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class UserController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly CommandBusInterface $commandBus,
    ) {}

    #[Route('/api/users', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse($this->queryBus->execute(new GetUsersQuery()));
    }

    #[Route('/api/users/{id}', methods: ['GET'])]
    public function getOne(string $id): JsonResponse
    {
        return new JsonResponse($this->queryBus->execute(new GetUserByIdQuery($id)));
    }

    #[Route('/api/users/{id}', methods: ['PATCH'])]
    public function editRole(string $id, Request $request): JsonResponse
    {
        $this->commandBus->execute(new UpdateRoleCommand($request->toArray()['role'], $id));

        return new JsonResponse();
    }
}
