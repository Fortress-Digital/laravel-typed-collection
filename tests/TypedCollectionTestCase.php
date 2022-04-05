<?php

namespace Fortress\TypeCollection\Tests;

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
    
    public function testPushWithTypeTrue(): void
    {
        $sut = new $this->collectionClass();
        $sut->push($this->validValues[0]);

        $this->assertCount(1, $sut);
        $this->assertEquals([$this->validValues[0]], $sut->all());
    }

    public function testPushWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", $this->collectionClass));

        $sut = new $this->collectionClass();
        $sut->push($this->invalidValues[0]);
    }

    public function testPutWithTypeTrue(): void
    {
        $sut = new $this->collectionClass();
        $sut->put('key', $this->validValues[0]);

        $this->assertCount(1, $sut);
        $this->assertEquals(['key' => $this->validValues[0]], $sut->all());
        $this->assertEquals($this->validValues[0], $sut->get('key'));
    }

    public function testPutWithInvalidType(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", $this->collectionClass));

        $sut = new $this->collectionClass();
        $sut->put('key', $this->invalidValues[0]);
    }

    public function testAddWithTypeTrue(): void
    {
        $sut = new $this->collectionClass();
        $sut->add($this->validValues[0]);

        $this->assertCount(1, $sut);
        $this->assertEquals($this->validValues[0], $sut->first());
    }

    public function testAddWithInvalidTrue(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage(sprintf("Invalid value type passed to %s", $this->collectionClass));

        $sut = new $this->collectionClass();
        $sut->add($this->invalidValues[0]);
    }
}
