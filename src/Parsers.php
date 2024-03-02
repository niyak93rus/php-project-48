<?php

declare(strict_types=1);

namespace App\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $pathToFile): array
{
    $file = file_get_contents($pathToFile);

    $data = [];

    if (str_ends_with($pathToFile, '.json')) {
        $data = json_decode($file, true);
    } elseif (str_ends_with($pathToFile, '.yaml') || str_ends_with($pathToFile, '.yml')) {
        $data = (array) Yaml::parse($file, Yaml::PARSE_OBJECT_FOR_MAP);
    }

    return $data;
}
