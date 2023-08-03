<?php

declare(strict_types=1);

namespace Ordermind\Helpers\Test\Unit\Misc;

use LogicException;
use PHPUnit\Framework\TestCase;
use ValueError;

use function Ordermind\Helpers\Misc\xrange;

class XrangeTest extends TestCase
{
    public function testSetsCorrectDefaultStep()
    {
        $expected = [1, 2, 3, 4, 5];

        $this->assertSame($expected, range(1, 5));
        $this->assertSame($expected, iterator_to_array(xrange(1, 5)));
    }

    /**
     * @dataProvider provideThrowsExceptionOnZeroStep
     */
    public function testRangeThrowsErrorOnZeroStep(int $start, int $end)
    {
        $this->expectException(ValueError::class);
        range($start, $end, 0);
    }

    /**
     * @dataProvider provideThrowsExceptionOnZeroStep
     */
    public function testXrangeThrowsExceptionOnZeroStep(int $start, int $end)
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Step cannot be zero');
        xrange($start, $end, 0);
    }

    public function provideThrowsExceptionOnZeroStep()
    {
        return [
            [1, 5],
            [5, 1],
            [-5, -1],
            [-1, -5],
            [-5, 5],
            [5, -5],
            [0, 0],
        ];
    }

    /**
     * @dataProvider providePositiveRangePositiveStep
     */
    public function testPositiveRangePositiveStep(array $expected, int $start, int $end, int $step)
    {
        $this->assertSame($expected, range($start, $end, $step));
        $this->assertSame($expected, iterator_to_array(xrange($start, $end, $step)));
    }

    public function providePositiveRangePositiveStep()
    {
        yield [[0, 1, 2, 3, 4, 5], 0, 5, 1];
        yield [[0, 2, 4, 6, 8, 10], 0, 10, 2];
        yield [[0, 3, 6, 9, 12, 15], 0, 15, 3];

        yield [[-3, -2, -1, 0, 1, 2, 3], -3, 3, 1];
        yield [[-6, -4, -2, 0, 2, 4, 6], -6, 6, 2];
        yield [[-5, -3, -1, 1, 3, 5], -5, 5, 2];
        yield [[-9, -6, -3, 0, 3, 6, 9], -9, 9, 3];

        yield [[-5, -4, -3, -2, -1, 0], -5, 0, 1];
        yield [[-10, -8, -6, -4, -2, 0], -10, 0, 2];
        yield [[-15, -12, -9, -6, -3, 0], -15, 0, 3];
    }

    /**
     * @dataProvider providePositiveRangeNegativeStep
     */
    public function testPositiveRangeNegativeStep(array $expected, int $start, int $end, int $step)
    {
        $this->assertSame($expected, range($start, $end, $step));
        $this->assertSame($expected, iterator_to_array(xrange($start, $end, $step)));
    }

    public function providePositiveRangeNegativeStep()
    {
        yield [[0, 1, 2, 3, 4, 5], 0, 5, -1];
        yield [[0, 2, 4, 6, 8, 10], 0, 10, -2];
        yield [[0, 3, 6, 9, 12, 15], 0, 15, -3];

        yield [[-3, -2, -1, 0, 1, 2, 3], -3, 3, -1];
        yield [[-6, -4, -2, 0, 2, 4, 6], -6, 6, -2];
        yield [[-5, -3, -1, 1, 3, 5], -5, 5, -2];
        yield [[-9, -6, -3, 0, 3, 6, 9], -9, 9, -3];

        yield [[-5, -4, -3, -2, -1, 0], -5, 0, -1];
        yield [[-10, -8, -6, -4, -2, 0], -10, 0, -2];
        yield [[-15, -12, -9, -6, -3, 0], -15, 0, -3];
    }

    /**
     * @dataProvider provideNegativeRangePositiveStep
     */
    public function testNegativeRangePositiveStep(array $expected, int $start, int $end, int $step)
    {
        $this->assertSame($expected, range($start, $end, $step));
        $this->assertSame($expected, iterator_to_array(xrange($start, $end, $step)));
    }

    public function provideNegativeRangePositiveStep()
    {
        yield [[5, 4, 3, 2, 1, 0], 5, 0, 1];
        yield [[10, 8, 6, 4, 2, 0], 10, 0, 2];
        yield [[15, 12, 9, 6, 3, 0], 15, 0, 3];

        yield [[3, 2, 1, 0, -1, -2, -3], 3, -3, 1];
        yield [[6, 4, 2, 0, -2, -4, -6], 6, -6, 2];
        yield [[5, 3, 1, -1, -3, -5], 5, -5, 2];
        yield [[9, 6, 3, 0, -3, -6, -9], 9, -9, 3];

        yield [[0, -1, -2, -3, -4, -5], 0, -5, 1];
        yield [[0, -2, -4, -6, -8, -10], 0, -10, 2];
        yield [[0, -3, -6, -9, -12, -15], 0, -15, 3];
    }

    /**
     * @dataProvider provideNegativeRangeNegativeStep
     */
    public function testNegativeRangeNegativeStep(array $expected, int $start, int $end, int $step)
    {
        $this->assertSame($expected, range($start, $end, $step));
        $this->assertSame($expected, iterator_to_array(xrange($start, $end, $step)));
    }

    public function provideNegativeRangeNegativeStep()
    {
        yield [[5, 4, 3, 2, 1, 0], 5, 0, -1];
        yield [[10, 8, 6, 4, 2, 0], 10, 0, -2];
        yield [[15, 12, 9, 6, 3, 0], 15, 0, -3];

        yield [[3, 2, 1, 0, -1, -2, -3], 3, -3, -1];
        yield [[6, 4, 2, 0, -2, -4, -6], 6, -6, -2];
        yield [[5, 3, 1, -1, -3, -5], 5, -5, -2];
        yield [[9, 6, 3, 0, -3, -6, -9], 9, -9, -3];

        yield [[0, -1, -2, -3, -4, -5], 0, -5, -1];
        yield [[0, -2, -4, -6, -8, -10], 0, -10, -2];
        yield [[0, -3, -6, -9, -12, -15], 0, -15, -3];
    }

    /**
     * @dataProvider provideNoRangePositiveStep
     */
    public function testNoRangePositiveStep(array $expected, int $start, int $end, int $step)
    {
        $this->assertSame($expected, range($start, $end, $step));
        $this->assertSame($expected, iterator_to_array(xrange($start, $end, $step)));
    }

    public function provideNoRangePositiveStep()
    {
        yield [[-5], -5, -5, 1];
        yield [[-5], -5, -5, 2];
        yield [[-5], -5, -5, 3];
        yield [[0], 0, 0, 1];
        yield [[0], 0, 0, 2];
        yield [[0], 0, 0, 3];
        yield [[5], 5, 5, 1];
        yield [[5], 5, 5, 2];
        yield [[5], 5, 5, 3];
    }

    /**
     * @dataProvider provideNoRangeNegativeStep
     */
    public function testNoRangeNegativeStep(array $expected, int $start, int $end, int $step)
    {
        $this->assertSame($expected, range($start, $end, $step));
        $this->assertSame($expected, iterator_to_array(xrange($start, $end, $step)));
    }

    public function provideNoRangeNegativeStep()
    {
        yield [[-5], -5, -5, -1];
        yield [[-5], -5, -5, -2];
        yield [[-5], -5, -5, -3];
        yield [[0], 0, 0, -1];
        yield [[0], 0, 0, -2];
        yield [[0], 0, 0, -3];
        yield [[5], 5, 5, -1];
        yield [[5], 5, 5, -2];
        yield [[5], 5, 5, -3];
    }
}
