<?php

declare(strict_types=1);

namespace App\GetDiff;

function gendiff($pathToFile1, $pathToFile2)
{
    $json1 = file_get_contents("./{$pathToFile1}");
    $json2 = file_get_contents("./{$pathToFile2}");
    $data1 = json_decode($json1, true);
    $data2 = json_decode($json2, true);
    
    $keys1 = array_keys($data1);
    $keys2 = array_keys($data2);

    $allKeys = array_unique(array_merge($keys1, $keys2));

    sort($allKeys);

    $diff = array_map(function ($key) use ($data1, $data2, $keys1, $keys2) {
        if (in_array($key, $keys1) && in_array($key, $keys2)) {
            if ($data1[$key] === $data2[$key]) {
                return [$key => ['name' => $key, 'state' => 'equal', 'value' => $data1[$key]]];
            } else {
                return [$key => ['name' => $key, 'state' =>'changed', 'oldValue' => $data1[$key], 'newValue' => $data2[$key]]];
            }
        } else {
            if (in_array($key, $keys1)) {
                return [$key => ['name' => $key, 'state' => 'deleted', 'value' => $data1[$key] ? 'true' : 'false']];
            } else {
                return [$key => ['name' => $key, 'state' => 'added', 'value' => $data2[$key] ? 'true' : 'false']];
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
