<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapter\Http;

use App\Application\Command\Assessment\FinishAssessmentCommand;
use App\Application\Command\CommandBusInterface;
use App\Application\Command\Assessment\CreateAssessmentCommand;
use App\Application\Query\Assessment\GetAssessmentsByUserIdQuery;
use App\Application\Query\QueryBusInterface;
use App\Application\Query\Assessment\GetAssessmentByIdQuery;
use App\Application\Query\Assessment\GetAssessmentsQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

final class AssessmentController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly CommandBusInterface $commandBus,
    ) {}

    #[Route('/api/assessments/{id}', methods: ['GET'])]
    public function getOne(string $id): JsonResponse
    {
        return new JsonResponse($this->queryBus->execute(new GetAssessmentByIdQuery($id)));
    }

    #[Route('/api/assessments', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateAssessmentCommand $command
    ): JsonResponse
    {
        return new JsonResponse($this->commandBus->execute($command));
    }

    #[Route('/api/assessments/{id}/complete', methods: ['POST'])]
    public function finish(
        string $id,
        Request $request,
    ): JsonResponse
    {
        $request = $request->toArray();
        $command = new FinishAssessmentCommand(
            new \DateTimeImmutable($request['nextAssessmentDate']),
            $id,
            $request['result'],
            $request['recommendation'],
            $request['newLevel']
        );

        return new JsonResponse($this->commandBus->execute($command));
    }
}
