<?php

namespace Fortress\TypeCollection;

use Illuminate\Support\Collection;
use UnexpectedValueException;

use function in_array;
use function is_float;
use function is_integer;
use function is_numeric;
use function is_string;

abstract class AbstractTypedCollection extends Collection
{
    protected string $type;

    private array $scalarTypes = [
        'decimal',
        'float',
        'integer',
        'int',
        'number',
        'numeric',
        'string',
        'text',
    ];

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
                "Invalid value type passed to %s",
                get_class($this)
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

    protected function acceptsType(mixed $value): bool
    {
        if (in_array($this->type, $this->scalarTypes)) {
            if ($this->type === 'decimal' || $this->type === 'float') {
                return is_float($value);
            }

            if ($this->type === 'int' || $this->type === 'integer') {
                return is_integer($value);
            }

            if ($this->type === 'number' || $this->type === 'numeric') {
                return is_numeric($value);
            }

            if ($this->type === 'string' || $this->type === 'text') {
                return is_string($value);
            }
        }

        return $value instanceof $this->type;
    }
}
