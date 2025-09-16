<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

enum Role: string
{
    case ADMINISTRATOR = 'administrator';
    case EMPLOYEE = 'employee';
    case MANAGER = 'manager';
}