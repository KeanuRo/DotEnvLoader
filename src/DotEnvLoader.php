<?php

class DotEnvLoader
{
    public function __construct($path)
    {
        if (!file_exists($path)) {
            throw new \Exception("File not found at path: {$path}");
        }
        $file = new SplFileObject($path);
        while (!$file->eof()) {
            $pair = $file->fgets();
            $pair = trim(str_replace(' ', '', $pair));
            list($key, $value) = explode('=', $pair, 2);
            if (strlen($key) > 0 && $key[0] != '#'){
                $_SERVER[$key] = $value;
            }
        }
    }
}