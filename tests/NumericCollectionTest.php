<?php

namespace Fortress\TypeCollection\Tests;

use Fortress\TypeCollection\NumericCollection;

class NumericCollectionTest extends TypedCollectionTestCase
{
    protected string $collectionClass = NumericCollection::class;

    protected array $validValues = ['1', '2'];

    protected array $invalidValues = ['string'];
}
