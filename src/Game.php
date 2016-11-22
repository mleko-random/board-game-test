<?php
/**
 * @package board-game
 */


namespace Mleko\BoardGame;


use Mleko\BoardGame\Exception\DuplicateShot;
use Mleko\BoardGame\Exception\OutOfTime;
use Mleko\BoardGame\Exception\PointOutOfBoard;
use Mleko\BoardGame\Exception\TooManyShots;

class Game
{
    const TIMEOUT = 60;

    /** @var Point */
    private $winningPoint;

    /** @var Point[] */
    private $checkedPoints = [];

    /** @var int */
    private $startTimestamp;

    /**
     * Game constructor.
     * @param Point $winningPoint
     * @param int $startTimestamp
     */
    public function __construct(Point $winningPoint, $startTimestamp)
    {
        if (!$this->isValidBoardPoint($winningPoint)) {
            throw new PointOutOfBoard();
        }
        $this->winningPoint = $winningPoint;
        $this->startTimestamp = $startTimestamp;
    }


    /**
     * @param Shot $shot
     * @return bool
     */
    public function checkShot(Shot $shot)
    {
        if (!$this->isValidBoardPoint($shot->getPoint())) {
            throw new PointOutOfBoard();
        }

        if (count($this->checkedPoints) >= 5) {
            throw new TooManyShots();
        }

        if ($shot->getTimestamp() - $this->startTimestamp > self::TIMEOUT) {
            throw new OutOfTime();
        }

        foreach ($this->checkedPoints as $point) {
            if ($point->equals($shot->getPoint())) {
                throw new DuplicateShot();
            }
        }

        if ($this->winningPoint->equals($shot->getPoint())) {
            return true;
        }

        $this->checkedPoints[] = $shot->getPoint();

        return false;
    }

    /**
     * @param Point $point
     * @return bool
     */
    public function isValidBoardPoint(Point $point)
    {
        return !($point->getX() < 0 || $point->getX() >= 5 || $point->getY() < 0 || $point->getY() >= 4);
    }
}
