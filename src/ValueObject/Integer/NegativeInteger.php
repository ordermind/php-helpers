<?php

declare(strict_types=1);

namespace Ordermind\Helpers\ValueObject\Integer;

use DomainException;

/**
 * Value object for a negative integer.
 */
class NegativeInteger extends AbstractInteger
{
    /**
     * {@inheritDoc}
     */
    protected function validate(int $value): void
    {
        if ($value >= 0) {
            throw new DomainException("The value must be a negative integer, given value was \"{$value}\".");
        }
    }
}
