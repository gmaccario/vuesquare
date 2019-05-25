<?php 

use \Foursquare\FoursquareApi;
use \Foursquare\FoursquareWrapper;

$foursquare = new FoursquareApi( CLIENT_ID, CLIENT_SECRET );

$foursquareWrapper = new FoursquareWrapper( $foursquare );

/* check params */
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
$ll = filter_input(INPUT_POST, 'll', FILTER_SANITIZE_STRING);
$intent = filter_input(INPUT_POST, 'intent', FILTER_SANITIZE_STRING);
$near = filter_input(INPUT_POST, 'near', FILTER_SANITIZE_STRING);
$id_venue = filter_input(INPUT_POST, 'id_venue', FILTER_SANITIZE_STRING);

if( isset( $action ))
{
	$foursquareWrapper->setAction( $action );
	$foursquareWrapper->setLL( $ll );
	$foursquareWrapper->setIntent( $intent );
	$foursquareWrapper->setNear( $near );
	$foursquareWrapper->setIdVenue( $id_venue );
	
	return $foursquareWrapper->executePost();
}

include( FTI_PATH_TEMPLATES . 'default.php' );
