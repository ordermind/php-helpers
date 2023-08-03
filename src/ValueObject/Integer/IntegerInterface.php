<?php

declare(strict_types=1);

namespace Ordermind\Helpers\ValueObject\Integer;

interface IntegerInterface
{
    /**
     * @return int The raw value.
     */
    public function getValue(): int;
}
