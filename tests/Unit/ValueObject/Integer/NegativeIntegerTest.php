<?php

declare(strict_types=1);

namespace Ordermind\Helpers\Test\Unit\ValueObject\Integer;

use DomainException;
use Ordermind\Helpers\ValueObject\Integer\NegativeInteger;
use PHPUnit\Framework\TestCase;
use TypeError;

class NegativeIntegerTest extends TestCase
{
    /**
     * @dataProvider provideInvalidInputCases
     */
    public function testThrowsExceptionOnInvalidInput(
        string $expectedExceptionClass,
        ?string $expectedExceptionMessage,
        $input
    ): void {
        $this->expectException($expectedExceptionClass);
        if ($expectedExceptionMessage) {
            $this->expectExceptionMessageMatches('/' . $expectedExceptionMessage . '/');
        }

        new NegativeInteger($input);
    }

    public function provideInvalidInputCases(): array
    {
        return [
            [TypeError::class, null, '-1'],
            [TypeError::class, null, false],
            [DomainException::class, 'The value must be a negative integer, given value was "0".', 0],
            [DomainException::class, 'The value must be a negative integer, given value was "1".', 1],
            [DomainException::class, 'The value must be a negative integer, given value was "100".', 100],
        ];
    }

    public function testCreatesObjectOnValidInput(): void
    {
        $positiveInteger = new NegativeInteger(-15);

        $this->assertSame(-15, $positiveInteger->getValue());
    }
}
