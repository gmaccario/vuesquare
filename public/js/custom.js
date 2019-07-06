var app = new Vue({
  el: '#foursquare-integration',
  mounted() {
      this.init();
    },
  data: {
	  debug: false,
	  
	  s: false,
	  
	  code: 200,
	  errorDetail: null,
	  
	  latitude: null,
	  longitude: null,
	  accuracy: null,
	  locatorVal: null,
	  b_geolocation: null,
	  
	  current_city: "",
	  searchLocator: "",
	  
	  photos:[],
	  venues: [],
	  categories: [],
	  venue_details:[]
  },
  methods:{
	  	init() {
	  		var options = {
					enableHighAccuracy: true,
					timeout: 5000,
					maximumAge: 0
			};
			this.getCurrentPosition( options );
	  	},
		getCurrentPosition( options ) {
			return navigator.geolocation.getCurrentPosition( 
				this.getCurrentPositionSuccess, 
				this.getCurrentPositionError, options 
			);
		},
		openCategoryDetails( id_category ){
			var self = this;
			
			this.venue_details = [];
			
			// self.s = false; // TODO...
			
			/*
			 * VENUES PER CATEGORY
			 */
			var jqxhr = jQuery.post( 
					"/", 
					{ 
						'action':'get_venues_per_category', 
						'll':self.latitude + "," + self.longitude,
						'categoryId':id_category,
						'intent':'checkin'
					}, 
				function( data ) {
						
					self.venues = [];
					
					jQuery( data.response.venues ).each(function( index, element ) {
						if( element.location.city && self.current_city == '')
						{
							self.current_city = element.location.city;
						}
			     		self.venues.push( element );
					});
					
					self.s = true;
					
					if( self.debug ) console.log( "success" );
		  		});
		},
		openVenueDetails( id_venue ){
			var self = this;
			
			this.venue_details = [];
			
			if( self.debug ) console.log( id_venue );
			
			/*
			 * VENUE DETAILS
			 */
			var jqxhr = jQuery.post( 
				"/", 
				{ 
					'action':'get_venue_details', 
					'id_venue':id_venue,
					'intent':'checkin'
				}, 
			function( data ) {
				self.venue_details.push( data.response.venue );
	  		});
			
			/*
			 * PHOTOS VENUE
			 */
			self.photos = [];
			
			var jqxhr = jQuery.post( 
					"/", 
					{ 
						'action':'get_photos_per_venue', 
						'id_venue':id_venue,
						'intent':'checkin'
					}, 
				function( data ) {
					if( self.debug ) console.log(data);
						
					jQuery( data.response.photos.items ).each(function( index, element ) {
						self.photos.push( element );
					});
		  		});
		},
		getCurrentPositionSuccess( pos ) {
			var self = this;
			var crd = pos.coords;
			
			this.latitude = crd.latitude;
			this.longitude = crd.longitude;
			this.accuracy = crd.accuracy;
			this.b_geolocation = true;

			/*
			 * GET VENUES PER CITY
			 */
			var jqxhr = jQuery.post( 
					"/", 
					{ 
						'action':'get_venues_per_current_city', 
						'll':self.latitude + "," + self.longitude,
						'intent':'checkin'
					}, 
				function( data ) {
					self.venues = [];
					
					self.code = data.meta.code;
					if(self.code >= 400)
					{
						self.errorDetail = data.meta.errorDetail;
					}
					
					if(200 == self.code)
					{
						jQuery( data.response.venues ).each(function( index, element ) {
							if( element.location.city && self.current_city == '')
							{
								self.current_city = element.location.city;
							}
							self.venues.push( element );
						});
						
						self.s = true;
						
						if( self.debug ) console.log( "success" );
					}
		  		});
			
			if(200 == self.code)
			{
				/*
				 * GET CATEGORIES
				 */
				var jqxhr = jQuery.post( 
					"/", 
					{ 
						'action':'get_categories', 
						'll':self.latitude + "," + self.longitude,
						'intent':'checkin'
					}, 
				function( data ) {
						self.s = false;
						
						self.categories = [];
						
						jQuery( data.response.categories ).each(function( index, element ) {
							self.categories.push( element );
						});
						
						self.s = true;
						
						if( self.debug ) console.log( "success" );
					});
			}
		},					
		getCurrentPositionError( err ) {
			this.b_geolocation = false;
			
			if( this.debug ) console.log( "NO GEOLOCATION!" );
		},
		searchByAddressZipCodeOrCity( event ){
			event.preventDefault();
			event.stopPropagation();

			var self = this;
			
			this.venue_details = [];

			/*
			 * VENUES NEAR TO
			 */
			var jqxhr = jQuery.post( 
				"/", 
				{ 
					'action':'search_near_to', 
					'near':self.searchLocator,
					'intent':'checkin'
				}, 
			function( data ) {
				self.venues = [];
					
				jQuery( data.response.venues ).each(function( index, element ) {
					self.venues.push( element );
				});
				
				self.s = true;
				
				if( self.debug )
				{
					console.log(self.venue_details);
					console.log( "success" );
				}
	  		});
		}
	}
});