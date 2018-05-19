<?php 
/*
Name: Foursquare Test Integration
URI: 
Description: 
Version: 1.0
Author: Giuseppe Maccario
Author URI: 
License: GPL2
*/

define( 'VERSION', 1.0 );

/* KEYS */
define( 'CLIENT_ID', 'YOUR_CLIENT_ID' );
define( 'CLIENT_SECRET', 'YOUR_CLIENT_SECRET' );

/* PATHs */
define( 'FTI_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define( 'FTI_PATH_INCLUDE', FTI_PATH . 'include' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_CLASSES', FTI_PATH . 'classes' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_TEMPLATES', FTI_PATH . 'templates' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_PUBLIC', FTI_PATH . 'public' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_CSS', FTI_PATH_PUBLIC . 'css' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_JS', FTI_PATH_PUBLIC . 'js' . DIRECTORY_SEPARATOR );
define( 'FTI_PATH_IMAGES', FTI_PATH_PUBLIC . 'img' . DIRECTORY_SEPARATOR );

/* URLs */
define( 'FTI_URL',  $_SERVER['REQUEST_URI']);
define( 'FTI_URL_PUBLIC', FTI_URL . 'public' . '/' );
define( 'FTI_URL_CSS', FTI_URL_PUBLIC . 'css' . '/' );
define( 'FTI_URL_JS', FTI_URL_PUBLIC . 'js' . '/' );
define( 'FTI_URL_IMAGES', FTI_URL_PUBLIC . 'img' . '/' );

function init()
{
	// AUTO LOADERs	
	require_once FTI_PATH_INCLUDE . 'autoload.php';
	
	// CONTROLLER
	include_once FTI_PATH_INCLUDE . 'controller.php';
}

/*
 * GO!
 */
init();