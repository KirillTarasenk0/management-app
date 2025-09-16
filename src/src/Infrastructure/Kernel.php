<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\ValueObject\Content;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Recommendation;
use App\Domain\ValueObject\Result;
use App\Domain\ValueObject\Weight;
use Doctrine\DBAL\Types\Type;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Yokai\DoctrineValueObject\Doctrine\Types;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private const DOCTRINE_VALUE_OBJECTS = [
        'name' => Name::class,
        'content' => Content::class,
        'weight' => Weight::class,
        'recommendation' => Recommendation::class,
        'result' => Result::class,
    ];

    public function __construct(string $environment, bool $debug)
    {
        parent::__construct($environment, $debug);
        (new Types(self::DOCTRINE_VALUE_OBJECTS))->register(Type::getTypeRegistry());
    }
}
