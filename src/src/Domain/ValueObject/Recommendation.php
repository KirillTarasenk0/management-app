<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Yokai\DoctrineValueObject\StringValueObject;

final readonly class Recommendation implements StringValueObject
{
    public function __construct(private string $recommendation) {}

    public static function fromValue(string $value): StringValueObject
    {
        return new static($value);
    }

    public function toValue(): string
    {
        return $this->recommendation;
    }

    public function __toString(): string
    {
        return $this->recommendation;
    }
}