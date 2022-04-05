<?php

namespace Fortress\TypeCollection\Tests;

use Fortress\TypeCollection\ObjectCollection;

class ObjectCollectionTest extends TypedCollectionTestCase
{
    protected string $collectionClass = ObjectCollection::class;

    protected array $validValues;

    protected array $invalidValues = ['string'];

    public function setUp(): void
    {
        $this->validValues = [
            new \stdClass(),
            new \stdClass(),
        ];
    }
}
