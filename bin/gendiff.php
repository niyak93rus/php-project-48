#!/usr/bin/env php

<?php

require './vendor/docopt/docopt/src/docopt.php';

require_once __DIR__ . '/../src/Diff.php';

use function App\Diff\gendiff;

$doc = <<<DOC
Usage:
    gendiff (-h|--help)
    gendiff (-v|--version)
    gendiff [--format <fmt>] <firstFile> <secondFile>

Generate diff

Options:
  -h --help             Show this screen
  -v --version          Show version
  --format <fmt>        Report format [default: stylish]

DOC;

$params = array(
    'argv' => array_slice($_SERVER['argv'], 1),
    'help' => true,
    'version' => 1.0,
    'optionsFirst' => false,
);

$args = Docopt::handle($doc, $params);

$diff = gendiff($args['<firstFile>'], $args['<secondFile>']);

print_r($diff);
