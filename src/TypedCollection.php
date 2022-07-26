<?php

namespace Fortress\TypeCollection;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use UnexpectedValueException;

use function func_get_args;
use function is_array;
use function is_float;
use function is_integer;
use function is_numeric;
use function is_object;
use function is_string;
use function strtolower;

abstract class TypedCollection extends Collection
{
    protected string $type;

    /**
     * AbstractTypedCollection constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        $items = $this->getArrayableItems($items);

        $this->validateValues($items);

        parent::__construct($items);
    }

    private function validateValues(array $items): void
    {
        foreach ($items as $item) {
            $this->validateValue($item);
        }
    }

    private function validateValue(mixed $value): void
    {
        if (!$this->acceptsType($value)) {
            throw new UnexpectedValueException(sprintf(
                "Invalid value type passed to %s, %s given",
                get_class($this),
                get_debug_type($value)
            ));
        }
    }

    final public function push(...$values): static
    {
        $this->validateValues($values);

        foreach ($values as $value) {
            $this->items[] = $value;
        }

        return $this;
    }

    final public function put(mixed $key, mixed $value): static
    {
        $this->validateValue($value);

        return parent::put($key, $value);
    }

    final public function add(mixed $item): static
    {
        $this->validateValue($item);

        return parent::add($item);
    }

    final public function prepend($value, $key = null): static
    {
        $this->validateValue($value);

        return parent::prepend(...func_get_args());
    }

    final public function offsetSet(mixed $key, mixed $value): void
    {
        $this->validateValue($value);

        parent::offsetSet($key, $value);
    }

    final public function toArray(): array
    {
        return $this->all();
    }

    protected function acceptsType(mixed $value): bool
    {
        return match (strtolower($this->type)) {
            'integer', 'int' => is_integer($value),
            'numeric', 'number' => is_numeric($value),
            'float', 'double', 'decimal' => is_float($value),
            'string', 'text' => is_string($value),
            'object' => is_object($value),
            'array' => is_array($value),
            'json' => (function () use ($value) {
                try {
                    json_decode($value, true, 512, JSON_THROW_ON_ERROR);
                } catch (\Throwable) {
                    return false;
                }

                return true;
            })(),
            default => $value instanceof $this->type,
        };
    }
}
