<?php

namespace App\Models;

class MapParser
{
    public function parse(string $map): array
    {
        $lines = explode("|", $map);
        $parsedMap = [];

        foreach ($lines as $i => $line) {
            $line = trim($line);
            $currentLine = [];
            $max = strlen($line);
            for($j = 0; $j < $max; $j++) {
                switch ($line[$j]) {
                    case 'B':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => Map::TYPE_BUILDING,
                        ];
                        break;
                    case 'W':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => Map::TYPE_WATER,
                        ];
                        break;
                    case 'L':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => Map::TYPE_LAND,
                        ];
                        break;
                    case '_':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => Map::TYPE_ROAD,
                        ];
                        break;
                    case 'C':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => Map::TYPE_COURIER,
                        ];
                        break;
                    case 'O':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => Map::TYPE_ORDER,
                        ];
                        break;
                    case 'R':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => Map::TYPE_RECIPIENT,
                        ];
                        break;
                    default:
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => Map::TYPE_UNKNOWN,
                        ];
                }
            }
            $parsedMap [] = $currentLine;
        }

        return $parsedMap;
    }

    /**
     * @param string $maze
     * @param string $rowDelimiter
     * @return Map
     */
    public function fromString(string $maze, string $rowDelimiter = "|"): Map
    {
        $tiles = [];

        foreach (explode($rowDelimiter, $maze) as $r => $row) {
            $rowTiles = [];
            foreach (str_split(trim($row)) as $c => $value) {
                $rowTiles[] = (object)[
                    'row' => $r,
                    'col' => $c,
                    'value' => $value
                ];
            }

            $tiles[] = $rowTiles;
        }

        return new Map($tiles);
    }
}
