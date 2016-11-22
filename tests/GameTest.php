<?php
/**
 * @package board-game
 */


namespace Mleko\BoardGame\Tests\Game;


use Mleko\BoardGame\Game;
use Mleko\BoardGame\Point;

class GameTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidStartingPoint()
    {
        $this->expectException(\RuntimeException::class);
        new Game(new Point(6, 6), time());
    }
}
