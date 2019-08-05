<?php 
require '../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Foursquare\FoursquareWrapper;

$config = include('../conf/config.php');

DEFINE('CLIENT_ID', $config['client_id']);
DEFINE('CLIENT_SECRET', $config['client_secret']);

class FoursquarewrapperTest extends TestCase
{
    public function testAction()
    {
        $foursquare = new FoursquareApi();
        
        $wrapper = new FoursquareWrapper($foursquare);
        
        $action = 'where-am-i';
        
        $wrapper->setAction($action);
        
        $actual = $wrapper->getAction();
        
        $this->assertEquals($action, $actual);
    }
}