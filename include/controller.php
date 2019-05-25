<?php 

use \Foursquare\FoursquareApi;
use \Foursquare\FoursquareWrapper;

$foursquare = new FoursquareApi( CLIENT_ID, CLIENT_SECRET );

$foursquareWrapper = new FoursquareWrapper( $foursquare );

/* check params */
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if( isset( $action ))
{
	$foursquareWrapper->setPost( $_POST );
	return $foursquareWrapper->executePost();
}

include( FTI_PATH_TEMPLATES . 'default.php' );
