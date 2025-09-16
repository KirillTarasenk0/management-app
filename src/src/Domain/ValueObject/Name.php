<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Yokai\DoctrineValueObject\StringValueObject;

final readonly class Name implements StringValueObject
{
    public function __construct(private string $name) {}

    public static function fromValue(string $value): StringValueObject
    {
        return new self($value);
    }

    public function toValue(): string
    {
        return (string)$this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}