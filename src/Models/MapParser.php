<?php

namespace App\Models;

class MapParser
{
    public function parse(string $map): array
    {
        $lines = explode("\n", $map);
        $parsedMap = [];

        foreach ($lines as $i => $line) {
            $max = strlen($line);
            for($j = 0; $j < $max; $j++) {
                switch ($line[$j]) {
                    case 'W':
                        $parsedMap[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => 'building'
                        ];
                        break;
                    case '_':
                        $parsedMap[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => 'road'
                        ];
                        break;
                    case 'X':
                        $parsedMap[] = [
                            'x' => $j,
                            'y' => $i,
                            'type' => 'user'
                        ];
                    break;
                }
            }
        }

        return $parsedMap;
    }
}
