<?php

declare(strict_types=1);

namespace App\Domain\Exception;

final class AssessmentNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Assessment not found');
    }
}