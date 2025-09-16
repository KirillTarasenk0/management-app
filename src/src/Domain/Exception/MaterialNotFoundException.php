<?php

declare(strict_types=1);

namespace App\Domain\Exception;

final class MaterialNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Material not found by id');
    }
}