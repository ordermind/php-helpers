<?php

declare(strict_types=1);

namespace Ordermind\Helpers\ValueObject\Integer;

use DomainException;

/**
 * Parent class for integer value objects
 */
abstract class AbstractInteger implements IntegerInterface
{
    protected int $value;

    public function __construct(int $value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @throws DomainException on failed validation.
     */
    abstract protected function validate(int $value): void;
}
