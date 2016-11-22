<?php
/**
 * @package board-game
 */


namespace Mleko\BoardGame;


class Point
{
    private $x;
    private $y;

    /**
     * Point constructor.
     * @param $x
     * @param $y
     */
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param Point $point
     * @return bool
     */
    public function equals(Point $point)
    {
        return $this->getX() === $point->getX() && $this->getY() === $point->getY();
    }
}
