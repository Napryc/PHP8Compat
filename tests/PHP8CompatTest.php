<?php

namespace Napryc\PHP8Compat\Tests;

use Napryc\PHP8Compat\PHP8Compat;
use PHPUnit\Framework\TestCase;

class PHP8CompatTest extends TestCase
{
    public function testMbStrPad()
    {
        $this->assertEquals("Hello     ", PHP8Compat::mb_str_pad("Hello", 10));
        $this->assertEquals("     Hello", PHP8Compat::mb_str_pad("Hello", 10, " ", STR_PAD_LEFT));
        $this->assertEquals("  Hello   ", PHP8Compat::mb_str_pad("Hello", 10, " ", STR_PAD_BOTH));
        $this->assertEquals("Hello*****", PHP8Compat::mb_str_pad("Hello", 10, "*"));
    }

    public function testStrContains()
    {
        $this->assertTrue(PHP8Compat::str_contains("Hello World", "World"));
        $this->assertTrue(PHP8Compat::str_contains("Hello World", ""));
        $this->assertFalse(PHP8Compat::str_contains("Hello World", "Python"));
    }

    public function testStrStartsWith()
    {
        $this->assertTrue(PHP8Compat::str_starts_with("Hello World", "Hello"));
        $this->assertFalse(PHP8Compat::str_starts_with("Hello World", "World"));
        $this->assertTrue(PHP8Compat::str_starts_with("Hello", ""));
    }

    public function testStrEndsWith()
    {
        $this->assertTrue(PHP8Compat::str_ends_with("Hello World", "World"));
        $this->assertFalse(PHP8Compat::str_ends_with("Hello World", "Hello"));
        $this->assertTrue(PHP8Compat::str_ends_with("Hello", ""));
    }

    public function testFdiv()
    {
        $this->assertEquals(5.0, PHP8Compat::fdiv(10.0, 2.0));
        $this->assertEquals(INF, PHP8Compat::fdiv(10.0, 0.0));
        $this->assertEquals(-INF, PHP8Compat::fdiv(-10.0, 0.0));
        $this->assertTrue(is_nan(PHP8Compat::fdiv(0.0, 0.0)));
    }

    public function testArrayIsList()
    {
        $this->assertTrue(PHP8Compat::array_is_list([]));
        $this->assertTrue(PHP8Compat::array_is_list([1, 2, 3]));
        $this->assertFalse(PHP8Compat::array_is_list([1 => 'a', 0 => 'b']));
        $this->assertFalse(PHP8Compat::array_is_list(['a' => 1, 'b' => 2]));
    }

    public function testStrIncrement()
    {
        $this->assertEquals('b', PHP8Compat::str_increment('a'));
        $this->assertEquals('aa', PHP8Compat::str_increment('z'));
        $this->assertEquals('B', PHP8Compat::str_increment('A'));
        $this->assertEquals('10', PHP8Compat::str_increment('9'));
        $this->assertEquals('a', PHP8Compat::str_increment(''));
    }

    public function testStrDecrement()
    {
        $this->assertEquals('a', PHP8Compat::str_decrement('b'));
        $this->assertEquals('z', PHP8Compat::str_decrement('aa'));
        $this->assertEquals('A', PHP8Compat::str_decrement('B'));
        $this->assertEquals('9', PHP8Compat::str_decrement('10'));
        $this->assertEquals('', PHP8Compat::str_decrement('a'));
    }

    public function testMbTrim()
    {
        $this->assertEquals('Hello', PHP8Compat::mb_trim('  Hello  '));
        $this->assertEquals('Hello', PHP8Compat::mb_trim('...Hello...', '.'));
        $this->assertEquals('Hello', PHP8Compat::mb_trim("\u{0085}Hello\u{0085}", "\u{0085}"));
    }

    public function testMbLtrim()
    {
        $this->assertEquals('Hello  ', PHP8Compat::mb_ltrim('  Hello  '));
        $this->assertEquals('Hello...', PHP8Compat::mb_ltrim('...Hello...', '.'));
    }

    public function testMbRtrim()
    {
        $this->assertEquals('  Hello', PHP8Compat::mb_rtrim('  Hello  '));
        $this->assertEquals('...Hello', PHP8Compat::mb_rtrim('...Hello...', '.'));
    }

    public function testMbUcfirst()
    {
        $this->assertEquals('Hello', PHP8Compat::mb_ucfirst('hello'));
        $this->assertEquals('HELLO', PHP8Compat::mb_ucfirst('hELLO'));
        $this->assertEquals('Über', PHP8Compat::mb_ucfirst('über'));
    }

    public function testMbLcfirst()
    {
        $this->assertEquals('hello', PHP8Compat::mb_lcfirst('Hello'));
        $this->assertEquals('hELLO', PHP8Compat::mb_lcfirst('HELLO'));
        $this->assertEquals('über', PHP8Compat::mb_lcfirst('Über'));
    }

    public function testJsonValidate()
    {
        $this->assertTrue(PHP8Compat::json_validate('{"key":"value"}'));
        $this->assertTrue(PHP8Compat::json_validate('[1,2,3]'));
        $this->assertFalse(PHP8Compat::json_validate('{invalid}'));
        $this->assertFalse(PHP8Compat::json_validate('[1,2,'));
    }

    public function testArrayFind()
    {
        $array = [1, 2, 3, 4, 5];
        $this->assertEquals(3, PHP8Compat::array_find($array, fn($x) => $x > 2));
        $this->assertEquals(null, PHP8Compat::array_find($array, fn($x) => $x > 5));

        $array = ['a' => 1, 'b' => 2];
        $this->assertEquals(2, PHP8Compat::array_find($array, fn($x, $k) => $k === 'b'));
    }

    public function testArrayFindKey()
    {
        $array = [1, 2, 3, 4, 5];
        $this->assertEquals(2, PHP8Compat::array_find_key($array, fn($x) => $x > 2));
        $this->assertEquals(null, PHP8Compat::array_find_key($array, fn($x) => $x > 5));

        $array = ['a' => 1, 'b' => 2];
        $this->assertEquals('b', PHP8Compat::array_find_key($array, fn($x) => $x === 2));
    }

    public function testArrayAny()
    {
        $array = [1, 2, 3, 4, 5];
        $this->assertTrue(PHP8Compat::array_any($array, fn($x) => $x > 4));
        $this->assertFalse(PHP8Compat::array_any($array, fn($x) => $x > 5));

        $array = ['a' => 1, 'b' => 2];
        $this->assertTrue(PHP8Compat::array_any($array, fn($x, $k) => $k === 'b'));
    }

    public function testArrayAll()
    {
        $array = [1, 2, 3, 4, 5];
        $this->assertTrue(PHP8Compat::array_all($array, fn($x) => $x > 0));
        $this->assertFalse(PHP8Compat::array_all($array, fn($x) => $x > 2));

        $array = ['a' => 1, 'b' => 2];
        $this->assertTrue(PHP8Compat::array_all($array, fn($x) => $x > 0));
    }
}

