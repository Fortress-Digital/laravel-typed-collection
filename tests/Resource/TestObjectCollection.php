<?php

namespace Fortress\TypeCollection\Tests\Resource;

use Fortress\TypeCollection\AbstractTypedCollection;

class TestObjectCollection extends AbstractTypedCollection
{
    protected string $type = TestObject::class;
}
