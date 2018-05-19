<?php 

use \Foursquare\FoursquareApi;
use \Foursquare\FoursquareWrapper;

$foursquare = new FoursquareApi( CLIENT_ID, CLIENT_SECRET );

$foursquareWrapper = new FoursquareWrapper( $foursquare );

/* check params */
if( isset( $_POST['action'] ))
{
	$foursquareWrapper->setPost( $_POST );
	return $foursquareWrapper->executePost();
}

include( FTI_PATH_TEMPLATES . 'default.php' );
