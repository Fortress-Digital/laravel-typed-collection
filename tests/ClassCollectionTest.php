<?php

namespace Fortress\TypeCollection\Tests;

use Fortress\TypeCollection\Tests\Resource\TestClass;
use Fortress\TypeCollection\Tests\Resource\TestClassCollection;
use PHPUnit\Framework\TestCase;

class ClassCollectionTest extends TestCase
{
    public function testCollectionType(): void
    {
        $this->assertEquals([new TestClass()], (new TestClassCollection([new TestClass()]))->all());
    }

    public function testToArrayOnArrayableClass(): void
    {
        $this->assertEquals([
            [
                'id' => 1,
            ],
            [
                'id' => 2,
            ]
        ], (new TestClassCollection([new TestClass(), new TestClass(2)]))->toArray());
    }
}
