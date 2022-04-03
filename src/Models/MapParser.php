<?php

namespace App\Models;

class MapParser
{
    public const TYPE_BUILDING = 'building';
    public const TYPE_WATER = 'water';
    public const TYPE_LAND = 'land';
    public const TYPE_ROAD = 'road';
    public const TYPE_COURIER = 'courier';
    public const TYPE_ORDER = 'order';
    public const TYPE_RECIPIENT = 'recipient';

    public const TYPE_UNKNOWN = 'unknown';

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
                            'type' => self::TYPE_BUILDING,
                        ];
                        break;
                    case 'W':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => self::TYPE_WATER,
                        ];
                        break;
                    case 'L':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => self::TYPE_LAND,
                        ];
                        break;
                    case '_':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => self::TYPE_ROAD,
                        ];
                        break;
                    case 'C':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => self::TYPE_COURIER,
                        ];
                        break;
                    case 'O':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => self::TYPE_ORDER,
                        ];
                        break;
                    case 'R':
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => self::TYPE_RECIPIENT,
                        ];
                        break;
                    default:
                        $currentLine[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => self::TYPE_UNKNOWN,
                        ];
                }
            }
            $parsedMap [] = $currentLine;
        }

        return $parsedMap;
    }
}
