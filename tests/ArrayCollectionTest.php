<?php

namespace Fortress\TypeCollection\Tests;

use Fortress\TypeCollection\ArrayCollection;

class ArrayCollectionTest extends TypedCollectionTestCase
{
    protected string $collectionClass = ArrayCollection::class;

    protected array $validValues = [
        [1],
        [2],
    ];

    protected array $invalidValues = ['string'];
}
