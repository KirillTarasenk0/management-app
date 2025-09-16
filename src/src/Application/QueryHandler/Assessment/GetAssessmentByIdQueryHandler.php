<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Assessment;

use App\Application\Dto\Assessment\AssessmentDto;
use App\Application\Dto\Factory\Assessment\AssessmentDtoFactory;
use App\Application\Query\Assessment\GetAssessmentByIdQuery;
use App\Application\Query\QueryHandlerInterface;
use App\Domain\Repository\AssessmentRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetAssessmentByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private AssessmentRepositoryInterface $assessmentRepository,
        private AssessmentDtoFactory $assessmentDtoFactory,
    ) {}

    public function __invoke(GetAssessmentByIdQuery $query): AssessmentDto
    {
        return $this->assessmentDtoFactory->create(
            $this->assessmentRepository->getOneById($query->getId()),
        );
    }
}