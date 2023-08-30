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

            $this->loadToServerArray($dotEnvVariable);
            $this->loadToLocalEnvVariable($dotEnvLine);
        }
    }

    private function loadToServerArray(DotEnvVariable $dotEnvVariable): void
    {
        $_SERVER[$dotEnvVariable->name] = $dotEnvVariable->value;
    }

    private function loadToLocalEnvVariable(DotEnvLine $dotEnvLine): void
    {
        putenv($dotEnvLine);
    }
}
