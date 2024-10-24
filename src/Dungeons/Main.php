<?php

namespace Dungeons;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
    public function onLoad(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->generateMaps(3, $this->generate(), 10, 10);
        }
    }

    public function generate(): CenterRoom
    {
        $center = new CenterRoom();
        $room = null;

        $count_rooms = 10;

        while ($count_rooms > 0) {
            if($center->getNextRoom() === null) {
                $center->setNextRoom(new Room());
            }

            if($room === null) {
                $room = $center->getNextRoom();
            } else {
                /**
                 * (-1,  1) | ( 0,  1) | ( 1,  1)
                 * (-1,  0) | ( 0,  0) | ( 1,  0)
                 * (-1, -1) | ( 0, -1) | ( 1, -1)
                 */

                $x = mt_rand(-1, 1);
                $y = mt_rand(-1, 1);

                if($x !== 0 && $y !== 0 || $x === 0 && $y === 0) {
                    mt_rand(0, 1) === 0 ? $x = 1 : $y = 1;
                }

                $nr = new Room(null, [$x, $y]);
                $room->setNextRoom($nr);
                $room = $room->getNextRoom();
            }

            $count_rooms--;
        }

        return $center;
    }

    public function generateMaps($count, $center, $rows, $cols): void
    {
        while ($count > 0) {
            $count--;
            var_dump($this->map($center, $rows, $cols));
        }
    }


    public function map(CenterRoom $room, int $rows, int $cols): string
    {
        $start_x = 0;
        $start_y = 0;
        $map = [];//matrix
        for ($i = $rows; $i >= -$rows; $i--) {
            for ($j = $cols; $j >= -$cols; $j--) {
                if ($i === $start_x && $j === $start_y) {
                    $map[$i][$j] = "■";
                } else {
                    $map[$i][$j] = "□";
                }
            }
        }

        $x = 0;
        $y = 0;

        while ($room->getNextRoom() !== null) {
            $room = $room->getNextRoom();
            $x += $room->getDirection()[0];
            $y += $room->getDirection()[1];
            $map[$x][$y] = "■";
        }

        return $this->printMap($map);
    }

    public function printMap(array $map): string
    {
        $result = "\n";
        foreach ($map as $row) {
            foreach ($row as $cell) {
                $result .= $cell;
            }
            $result .= "\n";
        }
        return $result;
    }








}