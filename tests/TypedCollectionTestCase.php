<?php

namespace Fortress\TypeCollection\Tests;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

use function sprintf;

abstract class TypedCollectionTestCase extends TestCase
{
    protected string $collectionClass;
    
    protected array $validValues = [];
    
    protected array $invalidValues = [];

    public function tearDown(): void
    {
        unset($this->collectionClass, $this->validValues, $this->invalidValues);
        
        parent::tearDown();
    }
    
    public function testCollectionCreationWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", $this->collectionClass));

        new $this->collectionClass($this->invalidValues);
    }

    public function testWithConstructWithCorrectTypes(): void
    {
        $this->assertEquals($this->validValues, (new $this->collectionClass($this->validValues))->all());
    }
    
    public function testPushWithValidType(): void
    {
        $sut = new $this->collectionClass();
        $sut->push($this->validValues[0]);

        self::assertCount(1, $sut);
        self::assertEquals([$this->validValues[0]], $sut->all());
    }

    public function testPushWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", $this->collectionClass));

        $sut = new $this->collectionClass();
        $sut->push($this->invalidValues[0]);
    }

    public function testPutWithValidType(): void
    {
        $sut = new $this->collectionClass();
        $sut->put('key', $this->validValues[0]);

        self::assertCount(1, $sut);
        self::assertEquals(['key' => $this->validValues[0]], $sut->all());
        self::assertEquals($this->validValues[0], $sut->get('key'));
    }

    public function testPutWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", $this->collectionClass));

        $sut = new $this->collectionClass();
        $sut->put('key', $this->invalidValues[0]);
    }

    public function testAddWithValidType(): void
    {
        $sut = new $this->collectionClass();
        $sut->add($this->validValues[0]);

        self::assertCount(1, $sut);
        self::assertEquals($this->validValues[0], $sut->first());
    }

    public function testAddWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", $this->collectionClass));

        $sut = new $this->collectionClass();
        $sut->add($this->invalidValues[0]);
    }

    public function testPrependWithValidType(): void
    {
        $sut = new $this->collectionClass($this->validValues);
        $sut->prepend($this->validValues[0]);

        $count = count($this->validValues);
        $expected = Arr::prepend($this->validValues, $this->validValues[0]);

        self::assertCount($count + 1, $sut);
        self::assertEquals($expected, $sut->all());
    }

    public function testPrependWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", $this->collectionClass));

        $sut = new $this->collectionClass($this->validValues);
        $sut->prepend($this->invalidValues[0]);
    }

    public function testOffsetSetValidType(): void
    {
        $sut = new $this->collectionClass();
        $sut[] = $this->validValues[0];

        self::assertCount(1, $sut);
        self::assertEquals($this->validValues[0], $sut->first());
    }

    public function testOffsetSetWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", $this->collectionClass));

        $sut = new $this->collectionClass();
        $sut[] = $this->invalidValues[0];
    }
}
