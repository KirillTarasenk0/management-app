<?php

declare(strict_types=1);

namespace App\Domain\Exception;

final class AssessmentDateIsLessThanCurrentException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Assessment date is less than current');
    }
}