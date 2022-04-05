<?php

namespace Fortress\TypeCollection\Tests;

use Fortress\TypeCollection\Tests\Resource\TestDecimalCollection;
use Fortress\TypeCollection\Tests\Resource\TestDoubleCollection;
use Fortress\TypeCollection\Tests\Resource\TestIntCollection;
use Fortress\TypeCollection\Tests\Resource\TestNumberCollection;
use Fortress\TypeCollection\Tests\Resource\TestClass;
use Fortress\TypeCollection\Tests\Resource\TestClassCollection;
use Fortress\TypeCollection\Tests\Resource\TestTextCollection;
use PHPUnit\Framework\TestCase;

class AlternateCollectionsTest extends TestCase
{
    public function testCollectionTypes(): void
    {
        $this->assertEquals([1.1, 2.1], (new TestDecimalCollection([1.1, 2.1]))->all());
        $this->assertEquals([1.1, 2.1], (new TestDoubleCollection([1.1, 2.1]))->all());
        $this->assertEquals([1, 2], (new TestIntCollection([1, 2]))->all());
        $this->assertEquals(['1', '2'], (new TestNumberCollection(['1', '2']))->all());
        $this->assertEquals(['test', 'string'], (new TestTextCollection(['test', 'string']))->all());
        $this->assertEquals([new TestClass()], (new TestClassCollection([new TestClass()]))->all());
    }
}
