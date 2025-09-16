<?php

declare(strict_types=1);

namespace App\Domain\Exception;

final class TopicNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Topic not found by id');
    }
}