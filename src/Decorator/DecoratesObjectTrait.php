<?php

declare(strict_types=1);

namespace Ordermind\Helpers\Decorator;

use LogicException;

/**
 * Trait for decorators so that you do not need to manually pass on every method and property.
 *
 * For IDE autocomplete integration, use the following phpdoc directives in the class (Remove parentheses around @):
 *
 * (@)mixin <decorated-class/interface>
 * (@)method <decorated-class/interface> getDecoratedObject
 */
trait DecoratesObjectTrait
{
    protected object $decoratedObject;

    public function __call(string $method, array $args)
    {
        if (!is_callable([$this->decoratedObject, $method])) {
            throw new LogicException('Call to undefined method ' . __CLASS__ . '::' . $method . '()');
        }

        return call_user_func_array([$this->decoratedObject, $method], $args);
    }

    public function __get(string $property)
    {
        if (!property_exists($this->decoratedObject, $property)) {
            throw new LogicException('Undefined property: ' . __CLASS__ . '::' . $property);
        }

        return $this->decoratedObject->$property;
    }

    public function __set(string $property, $value)
    {
        if (!property_exists($this->decoratedObject, $property)) {
            throw new LogicException('Undefined property: ' . __CLASS__ . '::' . $property);
        }

        $this->decoratedObject->$property = $value;

        return $this;
    }

    public function getDecoratedObject(): object
    {
        return $this->decoratedObject;
    }
}
