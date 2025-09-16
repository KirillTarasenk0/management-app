<?php

declare(strict_types=1);

namespace App\Domain\Exception;

final class LevelNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Level not found by id');
    }
}