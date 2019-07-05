<?php 
/*
Name: Foursquare Test Integration
URI: https://www.giuseppemaccario.com/foursquare-integration/
Description: My first integration using Foursquare and Vue.js.
Version: 1.0
Author: Giuseppe Maccario
Author URI: 
License: GPL2
*/

define( 'FTI_ENV', 'dev' );

if( FTI_ENV == 'dev' )
{
	ini_set('display_errors', 1);
	error_reporting(E_ALL);	
}

function fs_v_init()
{
    /* NEED PATHs */
    define( 'FTI_PATH', __DIR__ . DIRECTORY_SEPARATOR);
    define( 'FTI_PATH_INCLUDE', FTI_PATH . 'include' . DIRECTORY_SEPARATOR );
    
    /* Include constants */
    include_once FTI_PATH_INCLUDE . 'constants.php';
    
    /* Include autoloader */
	require_once FTI_PATH_INCLUDE . 'autoload.php';
	
	/* Include the controller */
	include_once FTI_PATH_INCLUDE . 'controller.php';
}

/*
 * GO!
 */
fs_v_init();