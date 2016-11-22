<?php
/**
 * @package board-game
 */


namespace Mleko\BoardGame\Tests\Game;


use Mleko\BoardGame\Exception\DuplicateShot;
use Mleko\BoardGame\Exception\OutOfTime;
use Mleko\BoardGame\Exception\PointOutOfBoard;
use Mleko\BoardGame\Exception\TooManyShots;
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
        $this->expectException(PointOutOfBoard::class);
        new Game(new Point(6, 6), time());
    }

    public function testWin()
    {
        $this->assertTrue($this->game->checkShot(new Shot(new Point(2, 2), 1002)));
    }

    public function testMiss()
    {
        $this->assertFalse($this->game->checkShot(new Shot(new Point(1, 2), 1002)));
    }

    public function testTimeout()
    {
        $this->expectException(OutOfTime::class);
        $this->assertTrue($this->game->checkShot(new Shot(new Point(2, 2), 2000)));
    }

    public function testDuplicateShot()
    {
        $this->expectException(DuplicateShot::class);
        $this->game->checkShot(new Shot(new Point(1, 2), 1001));
        $this->game->checkShot(new Shot(new Point(1, 2), 1001));
    }

    public function testRunOutOfShots()
    {
        $this->expectException(TooManyShots::class);
        $this->game->checkShot(new Shot(new Point(1, 1), 1001));
        $this->game->checkShot(new Shot(new Point(1, 2), 1001));
        $this->game->checkShot(new Shot(new Point(1, 3), 1001));
        $this->game->checkShot(new Shot(new Point(2, 0), 1001));
        $this->game->checkShot(new Shot(new Point(2, 1), 1001));
        $this->game->checkShot(new Shot(new Point(2, 2), 1001));
    }

    public function testOutOfBoardShot()
    {
        $this->expectException(PointOutOfBoard::class);
        $this->game->checkShot(new Shot(new Point(10, 2), 1001));
    }

    public function setUp()
    {
        $this->game = new Game(new Point(2, 2), 1000);
    }
}
