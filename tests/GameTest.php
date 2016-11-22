<?php
/**
 * @package board-game
 */


namespace Mleko\BoardGame\Tests\Game;


use Mleko\BoardGame\Game;
use Mleko\BoardGame\Point;
use Mleko\BoardGame\Shot;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Game
     */
    private $game;

    public function testInvalidStartingPoint()
    {
        $this->expectException(\RuntimeException::class);
        new Game(new Point(6, 6), time());
    }

    public function testWin()
    {
        $this->assertTrue($this->game->checkShot(new Shot(new Point(2, 2), 1002)));
    }

    public function testTimeout()
    {
        $this->expectException(\RuntimeException::class);
        $this->assertTrue($this->game->checkShot(new Shot(new Point(2, 2), 2000)));
    }

    public function testDuplicateShot()
    {
        $this->expectException(\RuntimeException::class);
        $this->game->checkShot(new Shot(new Point(1, 2), 1001));
        $this->game->checkShot(new Shot(new Point(1, 2), 1001));
    }

    public function setUp()
    {
        $this->game = new Game(new Point(2, 2), 1000);
    }
}
