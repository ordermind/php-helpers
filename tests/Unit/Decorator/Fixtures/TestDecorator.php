<?php

declare(strict_types=1);

namespace Ordermind\Helpers\Test\Unit\Decorator\Fixtures;

use Ordermind\Helpers\Decorator\DecoratesObjectTrait;

/**
 * @mixin DecoratedObject
 * @method DecoratedObject getDecoratedObject
 */
class TestDecorator
{
    use DecoratesObjectTrait;

    private string $extraProperty;

    public function __construct(DecoratedObject $decoratedObject, string $extraProperty)
    {
        $this->decoratedObject = $decoratedObject;
        $this->extraProperty = $extraProperty;
    }

    public function extraMethod(string $param): string
    {
        return $this->extraProperty . ' ' . $param;
    }
}
