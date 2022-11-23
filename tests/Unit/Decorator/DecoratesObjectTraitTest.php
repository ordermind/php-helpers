<?php

declare(strict_types=1);

namespace Ordermind\Helpers\Test\Unit\Decorator;

use LogicException;
use Ordermind\Helpers\Test\Unit\Decorator\Fixtures\DecoratedObject;
use Ordermind\Helpers\Test\Unit\Decorator\Fixtures\TestDecorator;
use PHPUnit\Framework\TestCase;

class DecoratesObjectTraitTest extends TestCase
{
    private TestDecorator $decorator;

    protected function setUp(): void
    {
        parent::setUp();

        $decoratedObject = new DecoratedObject('private property', 'protected property', 'public property');
        $this->decorator = new TestDecorator($decoratedObject, 'extra property');
    }

    public function testThrowsExceptionIfMethodDoesNotExist(): void
    {
        $this->expectExceptionObject(
            new LogicException('Call to undefined method ' . TestDecorator::class . '::missingMethod()')
        );
        $this->decorator->missingMethod();
    }

    public function testThrowsExceptionIfTryingToGetPropertyThatDoesNotExist(): void
    {
        $this->expectExceptionObject(
            new LogicException('Undefined property: ' . TestDecorator::class . '::missingProperty')
        );
        $this->decorator->missingProperty;
    }

    public function testThrowsExceptionIfTryingToSetPropertyThatDoesNotExist(): void
    {
        $this->expectExceptionObject(
            new LogicException('Undefined property: ' . TestDecorator::class . '::missingProperty')
        );
        $this->decorator->missingProperty = 'test';
    }

    public function testCanCallExtraMethod(): void
    {
        $this->assertSame('extra property my param', $this->decorator->extraMethod('my param'));
    }

    public function testCanCallPublicMethodOnDecoratedObject(): void
    {
        $this->assertSame('public property my param', $this->decorator->publicMethod('my param'));
    }

    public function testCanGetPublicPropertyOnDecoratedObject(): void
    {
        $this->assertSame('public property', $this->decorator->publicProperty);
    }

    public function testCanSetPublicPropertyOnDecoratedObject(): void
    {
        $this->decorator->publicProperty = 'edited public property';

        $this->assertSame('edited public property', $this->decorator->publicProperty);
        $this->assertSame('edited public property my param', $this->decorator->publicMethod('my param'));
    }
}
