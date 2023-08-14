<?php

namespace Loader;

class DotEnvLoader
{
    public function load($path)
    {
        $file = new DotEnvFile($path);
        while (false === $file->eof()) {
            $dotEnvLine = new DotEnvLine($file->fgets());
            $dotEnvVariable = $dotEnvLine->getDotEnvVariable();
            $_SERVER[$dotEnvVariable->name] = $dotEnvVariable->value;
        }
    }
}
