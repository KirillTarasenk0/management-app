<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Yokai\DoctrineValueObject\IntegerValueObject;

final readonly class Weight implements IntegerValueObject
{
    public function __construct(private int $weight) {}

    public static function fromValue(int $value): IntegerValueObject
    {
        return new self($value);
    }

    public function toValue(): int
    {
        return $this->weight;
    }
}