<?php

namespace Fortress\TypeCollection\Tests;

use Fortress\TypeCollection\StringCollection;

class StringCollectionTest extends TypedCollectionTestCase
{
    protected string $collectionClass = StringCollection::class;

    protected array $validValues = ['string 1', 'string 2'];

    protected array $invalidValues = [1, 2];
}
