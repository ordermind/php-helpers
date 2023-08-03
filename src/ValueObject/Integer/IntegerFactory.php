<?php

declare(strict_types=1);

namespace Ordermind\Helpers\ValueObject\Integer;

use DomainException;

/**
 * Creates a suitable integer value object based on the input value.
 */
class IntegerFactory
{
    public function create(int $value): IntegerInterface
    {
        if ($value > 0) {
            return new PositiveInteger($value);
        }

        if ($value < 0) {
            return new NegativeInteger($value);
        }

        return new ZeroValueInteger();
    }
}
