<?php

namespace Loader;


use Stringable;

class DotEnvLine implements Stringable
{
    private const DELIMITER = '=';

    private string $line;

    public function __construct(string $line)
    {
        if (false === str_contains($line, self::DELIMITER)) {
            throw new DotEnvLoaderException('Delimiter "' . self::DELIMITER . '" not found in dotenv line.');
        }

        if ('' === strstr($line, self::DELIMITER, true)) {
            throw new DotEnvLoaderException('Env parameter name not found.');
        }

        if (1 < substr_count($line, self::DELIMITER)) {
            throw new DotEnvLoaderException('More then one delimiter "' . self::DELIMITER . '" found in dotenv line.');
        }

        $this->line = $line;
    }

    public function __toString(): string
    {
        return $this->line;
    }

    public function getDotEnvVariable(): DotEnvVariable
    {
        return new DotEnvVariable(...explode(self::DELIMITER, $this->line));
    }
}
