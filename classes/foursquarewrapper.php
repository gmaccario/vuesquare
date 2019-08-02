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

if(!interface_exists('iFoursquareWrapper'))
{
    interface iFoursquareWrapper
    {
        public function setAction(string $action) : void;
        public function setLL(string $ll) : void;
        public function setIntent(?string $intent) : void;
        public function setName(?string $name) : void;
        public function setLimit(?int $limit) : void;
        public function setNear(?string $near) : void;
        public function setIdVenue(?string $id_venue) : void;
        
        public function getAction() : string;
        public function getLL() : string;
        public function getIntent() : ?string;
        public function getName() : ?string;
        public function getLimit() : ?int;
        public function getNear() : ?string ;
        public function getIdVenue() : ?string ;
        
        public function executePost() : ?string;
    }
}

if(!class_exists('FoursquareWrapper'))
{
    /**
     * @name FoursquareWrapper
     * @description Foursquare Wrapper that receive the FoursquareAPI object as dependency injection 
     * and use it to make the call to the Foursquare service. 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
	class FoursquareWrapper implements iFoursquareWrapper{
		
		protected $foursquare;
		protected $post;
		protected $action; 
		protected $ll;
		protected $intent;
		protected $name;
		protected $near;
		protected $id_venue;
		
		protected $endpoint = '';
		protected $params = [];
		
		/**
		 * @name __construct
		 *
		 * @param FoursquareApi $foursquare
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return
		 */
		public function __construct(FoursquareApi $foursquare)
		{
		    $this->foursquare = $foursquare;
		}
		
		/**
		 * @name setAction
		 * 
		 * @param string $action
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function setAction(string $action) : void
		{ 
		    $this->action = $action; 
		}
		
		/**
		 * @name setLL
		 *
		 * @param string $ll
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function setLL(string $ll) : void 
		{ 
		    $this->ll = $ll; 
		}
		
		/**
		 * @name setIntent
		 *
		 * @param string $intent
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function setIntent(?string $intent) : void 
		{ 
		    $this->intent = $intent; 
		}
		
		/**
		 * @name setName
		 *
		 * @param string $intent
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function setName(?string $name) : void
		{
		    $this->name = $name;
		}
		
		/**
		 * @name setLimit
		 *
		 * @param int $limit
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function setLimit(?int $limit) : void
		{
		    $this->limit = $limit;
		}
		
		/**
		 * @name setNear
		 *
		 * @param string $near
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function setNear(?string $near) : void 
		{ 
		    $this->near = $near; 
		}
		
		/**
		 * @name setIdVenue
		 *
		 * @param string $id_venue
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		public function setIdVenue(?string $id_venue) : void 
		{ 
		    $this->id_venue = $id_venue; 
		}
		
		/**
		 * @name getAction
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return string
		 */
		public function getAction() : string
		{ 
		    return $this->action; 
		}
		
		/**
		 * @name getLL
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return string
		 */
		public function getLL() : string 
		{ 
		    return $this->ll; 
		}
		
		/**
		 * @name getIntent
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return string
		 */
		public function getIntent() : ?string
		{ 
		    return $this->intent; 
		}
		
		/**
		 * @name getName
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return string
		 */
		public function getName() : ?string
		{
		    return $this->name;
		}
		
		/**
		 * @name getLimit
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return int
		 */
		public function getLimit() : ?int
		{
		    return $this->limit;
		}
		
		/**
		 * @name getNear
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return string
		 */
		public function getNear() : ?string 
		{ 
		    return $this->near; 
		}
		
		/**
		 * @name getIdVenue
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return string
		 */
		public function getIdVenue() : ?string 
		{ 
		    return $this->id_venue; 
		}
		
		/**
		 * @name executePost
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return ?string
		 */
		public function executePost() : ?string
		{
		    $this->preparePost();

		    if($this->endpoint != '' && count($this->params) > 0)
			{
			    $response = $this->foursquare->GetPublic($this->endpoint, $this->params);
			    
			    header('Content-Type: application/json');
			    
			    echo strip_tags($response);
			}
			
			return null;
		}
		
		/**
		 * @name preparePost
		 *
		 * @author G.Maccario <g_maccario@hotmail.com>
		 * @return void
		 */
		protected function preparePost() : void
		{
		    switch( $this->action )
		    {
		        case 'get-categories':
		            $this->endpoint = 'venues/categories';
		            $this->params['ll'] = $this->ll;
		            $this->params['intent'] = $this->intent;
		            break;
		        case 'where-i-am':
		            $this->endpoint = 'venues/search';
		            $this->params['ll'] = $this->ll;
		            $this->params['intent'] = $this->intent;
		            $this->params['limit'] = $this->limit;
		            break;
		        case 'get-venues-per-current-city':
		            $this->endpoint = 'venues/search';
		            $this->params['ll'] = $this->ll;
		            $this->params['intent'] = $this->intent;
		            break;
		        case 'get-venues-by-category':
		            $this->endpoint = 'venues/search';
		            $this->params['ll'] = $this->ll;
		            $this->params['intent'] = $this->intent;
		            $this->params['categoryId'] = $this->categoryId;
		            break;
		        case 'search-near-to':
		            $this->endpoint = 'venues/search';
		            $this->params['near'] = $this->near;
		            $this->params['intent'] = $this->intent;
		            break;
		        case 'get-venue-details':
		            $this->endpoint = sprintf('venues/%s', $this->id_venxue);
		            $this->params['intent'] = $this->intent;
		            break;
		        case 'get-photos-per-venue':
		            $this->endpoint = sprintf('venues/%s/photos', $this->id_venue);
		            $this->params['intent'] = $this->intent;
		            $this->params['group'] = 'venue';
		            break;
		        default:
		            break;
		    }
		}
	}
}