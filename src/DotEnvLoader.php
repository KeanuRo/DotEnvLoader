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
            $string = $file->fgets();
            $dotEnvString = new DotEnvString($string);
        }
    }
}

class DotEnvString{
    public function __construct($string)
    {
        $string = trim(str_replace(' ', '', $string));
        list($key, $value) = explode('=', $string, 2);
        if (strlen($key) > 0 && $key[0] != '#') {
            $_SERVER[$key] = $value;
        }
    }
}