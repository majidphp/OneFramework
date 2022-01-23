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
 * Init and application
 */
$App = new App;
$App->run();
