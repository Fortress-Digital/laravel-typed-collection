<?php

namespace Fortress\TypeCollection\Tests\Resource;

use Fortress\TypeCollection\AbstractGenericCollection;

class TestObjectCollection extends AbstractGenericCollection
{
    protected string $type = TestObject::class;
}
