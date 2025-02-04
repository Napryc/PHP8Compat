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
        $this->assertTrue(PHP8Compat::strStartsWith("Hello World", "Hello"));
        $this->assertFalse(PHP8Compat::strStartsWith("Hello World", "World"));
        $this->assertTrue(PHP8Compat::strStartsWith("Hello", ""));
    }

    public function testStrEndsWith()
    {
        $this->assertTrue(PHP8Compat::strEndsWith("Hello World", "World"));
        $this->assertFalse(PHP8Compat::strEndsWith("Hello World", "Hello"));
        $this->assertTrue(PHP8Compat::strEndsWith("Hello", ""));
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
}
