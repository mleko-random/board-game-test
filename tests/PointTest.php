<?php
/**
 * @package board-game
 */


namespace Mleko\BoardGame\Tests\Game;


use Mleko\BoardGame\Point;

class PointTest extends \PHPUnit_Framework_TestCase
{
    public function testEqual()
    {
        $p1 = new Point(1,2);
        $p2 = new Point(1,2);

        $this->assertTrue($p1->equals($p2));
    }

    public function testNonEqual()
    {
        $p1 = new Point(1,2);
        $p2 = new Point(2,2);

        $this->assertFalse($p1->equals($p2));
    }
}
