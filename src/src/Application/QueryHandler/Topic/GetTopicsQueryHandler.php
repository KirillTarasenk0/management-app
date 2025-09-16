<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Topic;

use App\Application\Dto\Factory\Topic\TopicDtoFactory;
use App\Application\Dto\Topic\TopicDto;
use App\Application\Query\QueryHandlerInterface;
use App\Application\Query\Topic\GetTopicsQuery;
use App\Domain\Entity\Topic;
use App\Domain\Repository\TopicRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetTopicsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private TopicRepositoryInterface $topicRepository,
        private TopicDtoFactory $topicDtoFactory,
    ) {}

    /**
     * @param GetTopicsQuery $query
     * @return TopicDto[]
     */
    public function __invoke(GetTopicsQuery $query): array
    {
        $topics = $this->topicRepository->getList();

        return array_map(fn(Topic $topic) => $this->topicDtoFactory->create($topic), $topics);
    }
}