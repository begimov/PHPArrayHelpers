<?php
use PHPUnit\Framework\TestCase;
use App\Helpers\ArrayHelpers;

class ArrayHelpersTest extends TestCase
{
    public function testGet()
    {
        $arr = [
          'first' => 'first',
          'second' => 'second',
          'third' => [
            'first' => 'third.first',
            'second' => 'third.second',
          ],
          'fourth' => [
            'first' => 'fourth.first',
            [
              'first' => 'fourth.0.first',
              'second' => 'fourth.0.second',
              ['fourth.0.0.0']
            ],
            'second' => [
              'first' => 'fourth.second.first',
              'second' => 'fourth.second.second',
            ]
          ],
          'fifth' => [],
          'sixth' => null
        ];
        $this->assertNull(ArrayHelpers::get($arr, 'sixth'));
        $this->assertNull(ArrayHelpers::get($arr));
        $this->assertNull(ArrayHelpers::get($arr, ''));
        $this->assertNull(ArrayHelpers::get(null, 'first'));
        $this->assertNull(ArrayHelpers::get([], 'first'));
        $this->assertNull(ArrayHelpers::get($arr, 'fourth.none'));

        $this->assertNull(ArrayHelpers::get(0, 'fourth.none', 'default'));

        $this->assertEquals([], ArrayHelpers::get($arr, 'fifth'));
        $this->assertEquals('first', ArrayHelpers::get($arr, 'first'));
        $this->assertEquals('third.first', ArrayHelpers::get($arr, 'third.first'));
        $this->assertEquals('fourth.second.second', ArrayHelpers::get($arr, 'fourth.second.second'));
        $this->assertEquals([
          'first' => 'fourth.second.first',
          'second' => 'fourth.second.second',
        ], ArrayHelpers::get($arr, 'fourth.second'));
        $this->assertEquals('fourth.0.first', ArrayHelpers::get($arr, 'fourth.0.first'));
        $this->assertEquals('fourth.0.0.0', ArrayHelpers::get($arr, 'fourth.0.0.0'));

        $this->assertEquals('fourth.0.0.0', array_get($arr, 'fourth.0.0.0', 'default'));

        $this->assertEquals('default', ArrayHelpers::get($arr, 'fourth.0.0.1', 'default'));
        $this->assertEquals('default', ArrayHelpers::get($arr, 'fourth.0.0.0.none', 'default'));
    }
}
