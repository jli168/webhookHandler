<?php

define('ENVIRONMENT', 'development');

error_reporting(E_ALL);
ini_set('display_errors', 1);


require( __DIR__."/GitHookHandler.php");

$postData = json_decode(file_get_contents('php://input'), true);

$gitHookHandler = new GitHookHandler( $postData );

