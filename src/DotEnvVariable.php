<?php

namespace Loader;

class DotEnvVariable
{
    public readonly string $name;
    public readonly string $value;

    public function __construct(string $name, string $value)
    {
        $this->name = trim($name);
        $this->value = trim($value);
    }
}
