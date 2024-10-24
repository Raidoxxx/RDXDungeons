<?php

namespace Dungeons;

class Room
{
    private Room $room;
    private Room|Null $nextRoom;
    private array $direction;
    public function __construct($next = null, $direction = null)
    {
        $this->room = $this;
        $this->nextRoom = $next;
        $this->direction = $direction ?? [mt_rand(-1,1), mt_rand(-1,1)];
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function getNextRoom(): Room|Null
    {
        return $this->nextRoom;
    }

    /** @return int[] */
    public function getDirection(): array
    {
        return $this->direction;
    }

    public function setNextRoom(Room $param): void
    {
        $this->nextRoom = $param;
    }
}