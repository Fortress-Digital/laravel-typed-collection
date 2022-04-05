<?php

namespace Fortress\TypeCollection\Tests;

use Fortress\TypeCollection\IntegerCollection;

class IntegerCollectionTest extends TypedCollectionTestCase
{
    protected string $collectionClass = IntegerCollection::class;

    protected array $validValues = [1, 2];

    protected array $invalidValues = [1.1];
}
