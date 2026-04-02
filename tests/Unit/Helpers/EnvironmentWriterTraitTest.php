<?php

namespace Tests\Unit\Helpers;

use App\Traits\Commands\EnvironmentWriterTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class EnvironmentWriterTraitTest extends TestCase
{
    #[DataProvider('variableDataProvider')]
    public function test_variable_is_escaped_properly($input, $expected)
    {
        $output = (new FooClass())->escapeEnvironmentValue($input);

        $this->assertSame($expected, $output);
    }

    public static function variableDataProvider(): array
    {
        return [
            ['foo', 'foo'],
            ['abc123', 'abc123'],
            ['val"ue', '"val\"ue"'],
            ['my test value', '"my test value"'],
            ['mysql_p@assword', '"mysql_p@assword"'],
            ['mysql_p#assword', '"mysql_p#assword"'],
            ['mysql p@$$word', '"mysql p@$$word"'],
            ['mysql p%word', '"mysql p%word"'],
            ['mysql p#word', '"mysql p#word"'],
            ['abc_@#test', '"abc_@#test"'],
            ['test 123 $$$', '"test 123 $$$"'],
            ['#password%', '"#password%"'],
            ['$pass ', '"$pass "'],
        ];
    }
}

class FooClass
{
    use EnvironmentWriterTrait;
}
