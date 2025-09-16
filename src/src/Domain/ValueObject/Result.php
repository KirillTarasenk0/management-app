<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Yokai\DoctrineValueObject\StringValueObject;

final readonly class Result implements StringValueObject
{
    public function __construct(private string $result) {}

    public static function fromValue(string $value): StringValueObject
    {
        return new static($value);
    }

    public function toValue(): string
    {
        return $this->result;
    }

    public function __toString(): string
    {
        return $this->result;
    }
}