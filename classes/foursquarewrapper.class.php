<?php

namespace Foursquare;

if( !class_exists( 'FoursquareWrapper' ))
{
	class FoursquareWrapper{
		
		protected $foursquare;
		protected $post;
		
		public function __construct( $f )
		{
			$this->foursquare = $f;
		}
		
		public function executePost()
		{
			switch( $this->post[ 'action' ] )
			{
				case 'get_current_city':
					$response = $this->foursquare->GetPublic( 'venues/search', array( 'll' => $this->post['ll'], 'intent' => $this->post['intent'] ) );
					break;
				case 'search_near_to':
					$response = $this->foursquare->GetPublic( 'venues/search', array( 'near' => $this->post[ 'near' ], 'intent' => $this->post['intent'] ) );
					break;
				case 'get_venue_details':
					$response = $this->foursquare->GetPublic( sprintf('venues/%s', $this->post[ 'id_venue' ]), array( 'intent' => $this->post['intent'] ) );
					break;
				default:
					break;
			}
			
			header('Content-Type: application/json');
			//echo json_encode( $response );
			echo $response;
		}
		
		public function setPost( $post )
		{
			$this->post = $post;
		}
	}
}