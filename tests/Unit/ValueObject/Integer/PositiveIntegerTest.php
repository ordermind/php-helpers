<?php

declare(strict_types=1);

namespace Ordermind\Helpers\Test\Unit\ValueObject\Integer;

use DomainException;
use Ordermind\Helpers\ValueObject\Integer\PositiveInteger;
use PHPUnit\Framework\TestCase;
use TypeError;

class PositiveIntegerTest extends TestCase
{
    /**
     * @dataProvider provideInvalidInputCases
     */
    public function testThrowsExceptionOnInvalidInput(
        string $expectedExceptionClass,
        string $expectedExceptionMessage,
        $input
    ): void {
        $this->expectException($expectedExceptionClass);
        $this->expectExceptionMessageMatches('/' . $expectedExceptionMessage . '/');
        new PositiveInteger($input);
    }

    public function provideInvalidInputCases(): array
    {
        return [
            [TypeError::class, 'must be of the type int, string given', '1'],
            [TypeError::class, 'must be of the type int, bool given', true],
            [DomainException::class, 'The value must be a positive integer, given value was "0".', 0],
            [DomainException::class, 'The value must be a positive integer, given value was "-1".', -1],
            [DomainException::class, 'The value must be a positive integer, given value was "-100".', -100],
        ];
    }

    public function testCreatesObjectOnValidInput(): void
    {
        $positiveInteger = new PositiveInteger(15);

        $this->assertSame(15, $positiveInteger->getValue());
    }
}
