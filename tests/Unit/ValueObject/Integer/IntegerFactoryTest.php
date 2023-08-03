<?php

declare(strict_types=1);

namespace Ordermind\Helpers\Test\Unit\ValueObject\Integer;

use Ordermind\Helpers\ValueObject\Integer\IntegerFactory;
use Ordermind\Helpers\ValueObject\Integer\IntegerInterface;
use Ordermind\Helpers\ValueObject\Integer\NegativeInteger;
use Ordermind\Helpers\ValueObject\Integer\PositiveInteger;
use Ordermind\Helpers\ValueObject\Integer\ZeroValueInteger;
use PHPUnit\Framework\TestCase;

class IntegerFactoryTest extends TestCase
{
    /**
     * @dataProvider provideCases
     */
    public function testInstantiatesCorrectClassBasedOnInput(IntegerInterface $expectedObject, int $input): void
    {
        $factory = new IntegerFactory();
        $this->assertEquals($expectedObject, $factory->create($input));
    }

    public function provideCases(): array
    {
        return [
            [new PositiveInteger(15), 15],
            [new ZeroValueInteger(), 0],
            [new NegativeInteger(-15), -15],
        ];
    }
}
