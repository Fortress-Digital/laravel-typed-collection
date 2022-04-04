<?php

namespace Fortress\TypeCollection\Tests;

use Fortress\TypeCollection\Tests\Resource\TestDecimalCollection;
use Fortress\TypeCollection\Tests\Resource\TestFloatCollection;
use Fortress\TypeCollection\Tests\Resource\TestIntCollection;
use Fortress\TypeCollection\Tests\Resource\TestIntegerCollection;
use Fortress\TypeCollection\Tests\Resource\TestNumberCollection;
use Fortress\TypeCollection\Tests\Resource\TestNumericCollection;
use Fortress\TypeCollection\Tests\Resource\TestObject;
use Fortress\TypeCollection\Tests\Resource\TestObjectCollection;
use Fortress\TypeCollection\Tests\Resource\TestStringCollection;
use PHPUnit\Framework\TestCase;

class AbstractTypedCollectionTest extends TestCase
{
    public function testCollectionTypes(): void
    {
        $this->assertEquals([1.1, 2.1], (new TestDecimalCollection([1.1, 2.1]))->all());
        $this->assertEquals([1.1, 2.1], (new TestFloatCollection([1.1, 2.1]))->all());
        $this->assertEquals([1, 2], (new TestIntegerCollection([1, 2]))->all());
        $this->assertEquals([1, 2], (new TestIntCollection([1, 2]))->all());
        $this->assertEquals(['1', '2'], (new TestNumberCollection(['1', '2']))->all());
        $this->assertEquals(['1', '2'], (new TestNumericCollection(['1', '2']))->all());
        $this->assertEquals(['test', 'string'], (new TestStringCollection(['test', 'string']))->all());
        $this->assertEquals([new TestObject()], (new TestObjectCollection([new TestObject()]))->all());
    }

    public function testCollectionCreationWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", TestIntegerCollection::class));

        new TestIntegerCollection([1, 'This is a string!']);
    }

    public function testPushWithTypeTrue(): void
    {
        $sut = new TestIntegerCollection();
        $sut->push(1);

        $this->assertCount(1, $sut);
        $this->assertEquals([1], $sut->all());
    }

    public function testPushWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", TestIntegerCollection::class));

        $sut = new TestIntegerCollection();
        $sut->push('This is a string!');
    }

    public function testPutWithTypeTrue(): void
    {
        $sut = new TestIntegerCollection();
        $sut->put('key', 1);

        $this->assertCount(1, $sut);
        $this->assertEquals(['key' => 1], $sut->all());
        $this->assertEquals(1, $sut->get('key'));
    }

    public function testPutWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", TestIntegerCollection::class));

        $sut = new TestIntegerCollection();
        $sut->put('key', 'This is a string!');
    }

    public function testAddWithTypeTrue(): void
    {
        $sut = new TestIntegerCollection();
        $sut->add(1);

        $this->assertCount(1, $sut);
        $this->assertEquals(1, $sut->first());
    }

    public function testAddWithInvalidTrue(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", TestIntegerCollection::class));

        $sut = new TestIntegerCollection();
        $sut->add('test');
    }
}
