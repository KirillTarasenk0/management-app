<?php

namespace App\Infrastructure\Adapter\Http;

use App\Application\Command\CommandBusInterface;
use App\Application\Command\Topic\CreateTopicCommand;
use App\Application\Command\Topic\DeleteTopicCommand;
use App\Application\Query\QueryBusInterface;
use App\Application\Query\Topic\GetTopicByIdQuery;
use App\Application\Query\Topic\GetTopicsQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

final class TopicController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly CommandBusInterface $commandBus,
    ) {}

    #[Route('/api/topics', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse($this->queryBus->execute(new GetTopicsQuery()));
    }

    #[Route('/api/topics/{id}', methods: ['GET'])]
    public function getOne(string $id): JsonResponse
    {
        return new JsonResponse($this->queryBus->execute(new GetTopicByIdQuery($id)));
    }

    #[Route('/api/topics/{id}', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        return new JsonResponse($this->commandBus->execute(new DeleteTopicCommand($id)));
    }

    #[Route('/api/topics', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateTopicCommand $command
    ): JsonResponse
    {
        return new JsonResponse($this->commandBus->execute($command));
    }
}
