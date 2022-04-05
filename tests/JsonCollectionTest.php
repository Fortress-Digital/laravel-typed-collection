<?php

namespace Fortress\TypeCollection\Tests;

use Fortress\TypeCollection\JsonCollection;

use function json_encode;

class JsonCollectionTest extends TypedCollectionTestCase
{
    protected string $collectionClass = JsonCollection::class;

    protected array $validValues;

    protected array $invalidValues = [[1]];

    public function setUp(): void
    {
        $this->validValues = [
            json_encode(['key1' => 'value1']),
            json_encode(['key2' => 'value2']),
        ];
    }
}
