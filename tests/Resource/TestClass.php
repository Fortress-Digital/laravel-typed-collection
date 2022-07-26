<?php

namespace Fortress\TypeCollection\Tests\Resource;

use Illuminate\Contracts\Support\Arrayable;

class TestClass implements Arrayable
{
    public function __construct(
        private int $id = 1
    ) {
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
