<?php

declare(strict_types=1);

namespace App\Infrastructure\Query\Bus;

use App\Application\Query\QueryBusInterface;
use App\Application\Query\QueryInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class QueryBus implements QueryBusInterface
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function execute(QueryInterface $query): mixed
    {
        return $this->handle($query);
    }
}
