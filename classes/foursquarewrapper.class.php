<?php
/**
 * FoursquareWrapper
 * 
 * 
 * @package php-foursquare 
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0.1
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Foursquare;

if( !class_exists( 'FoursquareWrapper' ))
{
	class FoursquareWrapper{
		
		protected $foursquare;
		protected $post;
		protected $action; 
		protected $ll;
		protected $intent;
		protected $near;
		protected $id_venue;
		
		public function __construct( $f )
		{
			$this->foursquare = $f;
		}
		
		public function setAction( $action ){ $this->action = $action; }
		public function setLL( $ll ){ $this->ll = $ll; }
		public function setIntent( $intent ){ $this->intent = $intent; }
		public function setNear( $near ){ $this->near = $near; }
		public function setIdVenue( $id_venue ){ $this->id_venue = $id_venue; }
		
		public function getAction(){ return $this->action; }
		public function getLL(){ return $this->ll; }
		public function getIntent(){ return $this->intent; }
		public function getNear(){ return $this->near; }
		public function getIdVenue(){ return $this->id_venue; }
		
		public function executePost()
		{
			switch( $this->action )
			{
				case 'get_categories':
					$response = $this->foursquare->GetPublic( 'venues/categories', array( 
						'll' => $this->ll, 
						'intent' => $this->intent 
						) 
					);
					break;
				case 'get_venues_per_current_city':
					$response = $this->foursquare->GetPublic( 'venues/search', array( 
						'll' => $this->ll, 
						'intent' => $this->intent 
						) 
					);
					break;
				case 'get_venues_per_category':
					$response = $this->foursquare->GetPublic( 'venues/search', array( 
						'll' => $this->ll, 
						'categoryId' => $this->categoryId, 
						'intent' => $this->intent 
						) 
					);
					break;
				case 'search_near_to':
					$response = $this->foursquare->GetPublic( 'venues/search', array( 
						'near' => $this->near, 
						'intent' => $this->intent 
						)
					);
					break;
				case 'get_venue_details':
					$response = $this->foursquare->GetPublic( sprintf('venues/%s', 
						$this->id_venue), 
						array( 
							'intent' => $this->intent 
							) 
						);
					break;
				case 'get_photos_per_venue':
					$response = $this->foursquare->GetPublic( sprintf('venues/%s/photos', 
						$this->id_venue), 
						array( 
							'intent' => $this->intent, 
							'group' => 'venue' 
							) 
						);
					break;
				default:
					break;
			}
			
			header('Content-Type: application/json');
			//echo json_encode( $response );
			echo $response;
		}
	}
}