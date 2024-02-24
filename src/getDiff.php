<?php

$pathToFile1 = '/fixtures/filepath1.json';
$pathToFile2 = '/fixtures/filepath2.json';

function genDiff($pathToFile1, $pathToFile2)
{
    $json1 = file_get_contents(__DIR__ . $pathToFile1);
    $json2 = file_get_contents(__DIR__ . $pathToFile2);
    $data1 = json_decode($json1);
    $data2 = json_decode($json2);

    var_dump($data1, $data2);
}
