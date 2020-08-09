<?php

declare(strict_types=1);

namespace Ordermind\Helpers\Misc;

use Generator;
use LogicException;

/**
 * Memory-efficient version of the native range() function. For now only integer ranges are supported.
 *
 * @param int $start
 * @param int $end
 * @param int $step  the step parameter is sanitized, so it doesn't matter if you provide a positive or negative number
 *                   as long as it is not zero
 *
 * @return Generator|int[]
 *
 * @throws LogicException
 */
function xrange(int $start, int $end, int $step = 1): Generator
{
    if ($step == 0) {
        throw new LogicException('Step cannot be zero');
    }

    $step = abs($step);

    return (function ($start, $end, $step): Generator {
        if ($start <= $end) {
            for ($index = $start; $index <= $end; $index += $step) {
                yield $index;
            }
        } else {
            for ($index = $start; $index >= $end; $index -= $step) {
                yield $index;
            }
        }
    })($start, $end, $step);
}
