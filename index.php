<?php
session_start();
/**
 * Show errors for debugging
 */
ini_set('display_errors','On');
/**
 * Load config files
 */
foreach(glob("Config/*.php") as $file){
    include_once $file;
}
/**
 * Load main class
 */
include_once SYSTEM_DIR.'App.php';
/**
 * Load packages
 */
include_once 'vendor/autoload.php';
/** 
 * Init App
 */
$App = new App;
$index = $App->init();
/**
 * Run main app
 */
$run = $App->run(
    $index['router']['controller'],
    $index['router']['action'],
    params:$index['router']['params'],
    data:$index['data'],
);
