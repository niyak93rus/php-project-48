#!/usr/bin/env php

<?php
require('./vendor/docopt/docopt/src/docopt.php');

// short form (5.4 or better)

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

// $args = (new \Docopt\Handler)->handle($sdoc);

// // long form, simple API (equivalent to short)
$params = array(
    'argv'=>array_slice($_SERVER['argv'], 1),
    'help'=>true,
    'version'=>1.0,
    'optionsFirst'=>false,
);

$args = Docopt::handle($doc, $params);
