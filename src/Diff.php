<?php

declare(strict_types=1);

namespace App\Diff;

use function App\Parsers\parse;

function printValue(mixed $value): mixed
{
    if ($value === true) {
        return 'true';
    } elseif ($value === false) {
        return 'false';
    } else {
        return $value;
    }
}

function gendiff(string $pathToFile1, string $pathToFile2): string
{
    $data1 = parse($pathToFile1);
    $data2 = parse($pathToFile2);

    $keys1 = array_keys($data1);
    $keys2 = array_keys($data2);

    $allKeys = array_unique(array_merge($keys1, $keys2));

    sort($allKeys);

    $diff = array_map(function ($key) use ($data1, $data2, $keys1, $keys2) {
        if (in_array($key, $keys1) && in_array($key, $keys2)) {
            if ($data1[$key] === $data2[$key]) {
                return [$key => ['name' => $key, 'state' => 'equal', 'value' => $data1[$key]]];
            } else {
                return [
                    $key => [
                            'name' => $key, 'state' => 'changed', 'oldValue' => $data1[$key], 'newValue' => $data2[$key]
                        ]
                    ];
            }
        } else {
            if (in_array($key, $keys1)) {
                return [$key => [
                    'name' => $key,
                    'state' => 'deleted',
                    'value' => printValue($data1[$key])
                ]];
            } else {
                return [$key => ['name' => $key, 'state' => 'added', 'value' => printValue($data2[$key])]];
            }
        }
    }, $allKeys);

    $result = array_merge([], ...$diff);

    $output = array_map(function ($key) {
        switch ($key['state']) {
            case 'equal':
                return "    {$key['name']}: {$key['value']}";
            case 'changed':
                return "  - {$key['name']}: {$key['oldValue']}\n  + {$key['name']}: {$key['newValue']}";
            case 'deleted':
                return "  - {$key['name']}: {$key['value']}";
            case 'added':
                return "  + {$key['name']}: {$key['value']}";
        }
    }, $result);

    $imploded = implode("\n", $output);

    $finalOutput = "{\n{$imploded}\n}\n";

    return $finalOutput;
}
