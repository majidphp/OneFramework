<?php
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
include_once CLI_PATH.'vendor/autoload.php';
