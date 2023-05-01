<?php
if ($argc < 2) echo "Use --help to show how to use cli \n";
include_once 'MainCommand.php';
$file = $argv[1];
include_once "$file.php";
$args = array_shift($argv);
$obj = new $file;
