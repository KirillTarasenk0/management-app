<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Topic;

use App\Application\Dto\Factory\Topic\TopicDtoFactory;
use App\Application\Dto\Topic\TopicDto;
use App\Application\Query\QueryHandlerInterface;
use App\Application\Query\Topic\GetTopicByIdQuery;
use App\Domain\Repository\TopicRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetTopicByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private TopicRepositoryInterface $topicRepository,
        private TopicDtoFactory $topicDtoFactory,
    ) {}

    public function __invoke(GetTopicByIdQuery $query): TopicDto
    {
        return $this->topicDtoFactory->create(
            $this->topicRepository->getOneById($query->getId()),
        );
    }
}