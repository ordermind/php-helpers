<?php

declare(strict_types=1);

namespace Ordermind\Helpers\ValueObject\Integer;

/**
 * Value object for a zero-value integer.
 */
class ZeroValueInteger implements IntegerInterface
{
    public function getValue(): int
    {
        return 0;
    }
}
