<?php

declare(strict_types=1);

namespace Ordermind\Helpers\Test\Unit\Decorator\Fixtures;

class DecoratedObject
{
    private string $privateProperty;
    protected string $protectedProperty;
    public string $publicProperty;

    public function __construct(string $privateProperty, string $protectedProperty, string $publicProperty)
    {
        $this->privateProperty = $privateProperty;
        $this->protectedProperty = $protectedProperty;
        $this->publicProperty = $publicProperty;
    }

    private function privateMethod(string $param): string
    {
        return $this->privateProperty . ' ' . $param;
    }

    protected function protectedMethod(string $param): string
    {
        return $this->protectedProperty . ' ' . $param;
    }

    public function publicMethod(string $param): string
    {
        return $this->publicProperty . ' ' . $param;
    }
}
