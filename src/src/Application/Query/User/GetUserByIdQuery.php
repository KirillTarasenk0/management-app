<?php

declare(strict_types=1);

namespace App\Application\Query\User;

use App\Application\Query\QueryInterface;

final readonly class GetUserByIdQuery implements QueryInterface
{
    public function __construct(
        private string $id,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }
}