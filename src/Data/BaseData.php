<?php

declare(strict_types=1);

namespace Cranbri\Livepeer\Data;

abstract class BaseData
{
    /**
     * Convert the DTO to an array
     *
     * @return array
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
                $array[$name] = $value;
            }
        }

        return $array;
    }
}