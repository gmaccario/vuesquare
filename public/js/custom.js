var app = new Vue({
  el: '#app',
  mounted() {
      this.init();
    },
  data: {
	  debug: false,
	  
	  s: false,
	  sVenue: false,
	  open_details: false,
	  show_form: false,
	  
	  latitude: null,
	  longitude: null,
	  accuracy: null,
	  locatorVal: null,
	  b_geolocation: null,
	  
	  current_city: "",
	  searchLocator: "",
	  
	  photos:[],
	  venues: [],
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
			return navigator.geolocation.getCurrentPosition( this.getCurrentPositionSuccess, this.getCurrentPositionError, options );
		},
		openVenueDetails( id_venue ){
			this.sVenue = false;
			var self = this;
			
			this.venue_details = [];
			this.open_details = false;
			
			if( self.debug )
				console.log( id_venue );
			
			var jqxhr = jQuery.post( 
				"/", 
				{ 
					'action':'get_venue_details', 
					'id_venue':id_venue,
					'intent':'checkin'
				}, 
			function( data ) {
				self.open_details = true;

				self.b_geolocation = true;
				
				/*if( show_form )
					self.b_geolocation = false;
				else
					self.b_geolocation = true;*/

				self.sVenue = true;
				
				self.venue_details.push( data.response.venue );
	  		});
		},
		getCurrentPositionSuccess( pos ) {
			var crd = pos.coords;
			
			this.latitude = crd.latitude;
			this.longitude = crd.longitude;
			this.accuracy = crd.accuracy;
			
			var self = this;
			
			this.show_form = false;
			this.b_geolocation = true;
			
			var jqxhr = jQuery.post( 
					"/", 
					{ 
						'action':'get_current_city', 
						'll':self.latitude + "," + self.longitude,
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
					
					if( self.debug )
						console.log( "success" );
		  		});
		},					
		getCurrentPositionError( err ) {
			this.s = false;
			
			this.show_form = true;
			
			this.b_geolocation = false;
			
			if( this.debug )
				console.log( "ERROR" );
		},
		searchByAddressZipCodeOrCity( event ){
			event.preventDefault();
			event.stopPropagation();

			this.sVenue = false;
			var self = this;
			
			this.venue_details = [];
			this.open_details = false;
			this.show_form = true;
			
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
					console.log(self.venue_details);
				
				if( self.debug )
					console.log( "success" );
	  		});
		}
	}
});