<?php
/**
 * @package board-game
 */


namespace Mleko\BoardGame;


class Shot
{
    /** @var Point */
    private $point;

    /** @var int */
    private $timestamp;

    /**
     * Shot constructor.
     * @param Point $point
     * @param int $timestamp
     */
    public function __construct(Point $point, $timestamp)
    {
        $this->point = $point;
        $this->timestamp = $timestamp;
    }

    /**
     * @return Point
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

}
