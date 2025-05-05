<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data;

abstract class BaseData
{
    /**
     * Convert the DTO to an array
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

        $array = [];
        foreach ($properties as $property) {
            $name = $property->getName();
            $value = $property->getValue($this);

            if ($value !== null) {
                $array[$name] = $this->processValue($value);
            }
        }

        return $array;
    }

    private function processValue(mixed $value): mixed
    {
        if ($value instanceof \BackedEnum) {
            return $value->value;
        } elseif ($value instanceof BaseData) {
            return $value->toArray();
        } elseif (is_array($value)) {
            $result = [];
            foreach ($value as $key => $item) {
                $result[$key] = $this->processValue($item);
            }

            return $result;
        } else {
            return $value;
        }
    }
}
