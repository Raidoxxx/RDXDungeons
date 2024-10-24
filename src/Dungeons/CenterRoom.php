<?php

namespace Dungeons;

class CenterRoom
{
    private CenterRoom $room;
    private Room|Null $nextRoom;

    public function __construct($next = null)
    {
        $this->room = $this;
        $this->nextRoom = $next;
    }

    public function getRoom(): CenterRoom
    {
        return $this->room;
    }

    public function getNextRoom(): Room|Null
    {
        return $this->nextRoom;
    }

    public function setNextRoom(Room $param): void
    {
        $this->nextRoom = $param;
    }
}