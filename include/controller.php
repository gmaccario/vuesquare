<?php 

use \Foursquare\FoursquareWrapper;

/* check params */
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING, array('options'=>array('default'=> '')));

if($action != '')
{
    /**
     * Get values from POST 
     * 
     */
    $ll = filter_input(INPUT_POST, 'll', FILTER_SANITIZE_STRING);
    $intent = filter_input(INPUT_POST, 'intent', FILTER_SANITIZE_STRING);
    $near = filter_input(INPUT_POST, 'near', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $limit = filter_input(INPUT_POST, 'limit', FILTER_SANITIZE_NUMBER_INT);
    $id_venue = filter_input(INPUT_POST, 'id_venue', FILTER_SANITIZE_STRING);
    $category_id = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_STRING);
    
    /**
     * https://github.com/hownowstephen/php-foursquare
     * @var \FoursquareApi $foursquare
     */
    $foursquare = new \FoursquareApi(CLIENT_ID, CLIENT_SECRET);
    
    $foursquareWrapper = new FoursquareWrapper($foursquare);
	$foursquareWrapper->setAction($action);
	$foursquareWrapper->setLL($ll);
	$foursquareWrapper->setIntent($intent);
	$foursquareWrapper->setNear($near);
	$foursquareWrapper->setName($name);
	$foursquareWrapper->setLimit($limit);
	$foursquareWrapper->setIdVenue($id_venue);
	$foursquareWrapper->setCategoryId($category_id);
	
	return $foursquareWrapper->executePost();
}

include( FTI_PATH_TEMPLATES . 'default.php' );