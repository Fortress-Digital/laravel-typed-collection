<?php

namespace Fortress\TypeCollection\Tests;

use Fortress\TypeCollection\FloatCollection;

class FloatCollectionTest extends TypedCollectionTestCase
{
    protected string $collectionClass = FloatCollection::class;

    protected array $validValues = [1.1, 2.1];

    protected array $invalidValues = ['string'];
}
