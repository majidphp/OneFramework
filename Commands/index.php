<?php
include_once 'MainCommand.php';
$file = $argv[1];
include_once "$file.php";
array_shift($argv);
call_user_func('main', [$argv]);
