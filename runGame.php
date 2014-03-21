<?php

require_once __DIR__ . '/vendor/autoload.php';

if ($argc != 2) {
    die("Usage: index.php {numberOfMonsters}\n");
}

$app = new \Daniel\Game\Application(__DIR__ .'/world_map.txt', $argv[1]);
$app->play();
