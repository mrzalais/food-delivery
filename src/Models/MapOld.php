<?php

namespace App\Models;

class MapOld
{
    public array $parsed;
    public string $string;

    public function __construct(string $map)
    {
        $parser = new MapParser;
        $this->string = $map;
        $this->parsed = $parser->parse($map);
    }

    public function insertObject(array $coordinates, string $type): void
    {
        $this->parsed[$coordinates['y']][$coordinates['x']]['type'] = $type;
    }
}
