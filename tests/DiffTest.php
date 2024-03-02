<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use function App\Diff\gendiff;

class DiffTest extends TestCase
{
    public function testDiff(): void
    {
        $filepath1 = 'tests/fixtures/filepath1.json';
        $filepath2 = 'tests/fixtures/filepath2.json';
        $filepath3 = 'tests/fixtures/filepath1.yml';
        $filepath4 = 'tests/fixtures/filepath2.yml';

        $expected = file_get_contents(__DIR__ . '/fixtures/expected.txt');

        $this->assertEquals($expected, gendiff($filepath1, $filepath2));
        $this->assertEquals($expected, gendiff($filepath3, $filepath4));
    }
}
