/* *****************************************************************************************
 *  
 *  Child Components 
 *  
 *  
 */

/**
 * Current Location
 */
const FSCurrentLocation = Vue.component('fs-current-location',{
	props: {
		config: {
			type: Object,
			required: true
		}
	},
	data(){
		return {
			location_name: '',
			location: {}
		}
	},
	created: function () {
    	this.setWhereIAm();
	},
	methods: {
		/**
    	 * @name setWhereIAm
    	 * @description More precise info on where the user is located.
    	 */
		setWhereIAm() {
			
			// ES2017 async/await support
			// @note Reverse Geocoding...
			// check also https://wiki.openstreetmap.org/wiki/Nominatim#Reverse_Geocoding_.2F_Address_lookup
			const params = new URLSearchParams();
			params.append('action', 'where-i-am');
			params.append('ll', this.config.latitude + "," + this.config.longitude);
			params.append('intent', 'checkin');
			params.append('limit', 1);
			
			axios.post('/', params).then((response) => {
				if(response.data.response.venues[0])
				{
					this.location_name = response.data.response.venues[0].name;
					this.location = response.data.response.venues[0].location;	
				}
			});
    	}
	},
  	template:`  	
  		<div class="wrapper current-location">
		  	<h4>Current Location</h4>
		  	
		  	<p class="welcome">
		  		<i class="fa fa-map-marker" aria-hidden="true"></i>
		  		
		  		<span v-show="!location_name">Loading...</span>
		  		
		  		<span v-show="location_name">You are in {{ location_name }} - {{ location.country }} ({{ location.cc }})</span>
		  		
		  		<p>Here your precise location:</p>
		  	</p>
		  	
		  	<ul>
		  		<li><span class="label">Latitude: </span><span class="value">{{ config.latitude }}</span></li>
		  		<li><span class="label">Longitude: </span><span class="value">{{ config.longitude }}</span></li>
		  		<li><span class="label">Accuracy: </span><span class="value">&cong; {{ parseInt(config.accuracy) }} meters</span></li>
		  	</ul>
  		</div>`
});

/**
 * Categories
 */
const FSCategories = Vue.component('fs-categories',{
	props: {
		config: {
			type: Object,
			required: true
		}
	},
	data(){
		return {
			categories: []
		}
	},
	created: function () {
    	this.getCategories();
	},
	methods: {
		/**
    	 * @name getCategories
    	 * @description Get categories
    	 */
		getCategories() {

			// ES2017 async/await support
			const params = new URLSearchParams();
			params.append('action', 'get_categories');
			params.append('ll', this.config.latitude + "," + this.config.longitude);
			params.append('intent', 'checkin');
			
			axios.post('/', params).then((response) => {
				this.categories = response.data.response.categories;
			});
    	}
	},
  	template:`  	
  		<div class="wrapper categories">
		  	<h4>Categories</h4>
		  	
  			<p v-show="!categories.length">Loading...</p>
		  	
		  	<ul>
		  		<li v-for="category in categories">
		  			<div class="thumbnail">
		  				<a href="#" @click="openCategoryDetails(category.id);">
  							<img :src="category.icon.prefix + '32' + category.icon.suffix" />
  							<span class="shortName">{{ category.shortName }}</span>
		  				</a>
		  			</div>
		  		</li>
		  	</ul>
  		</div>`
});

/**
 * Venue Details
 */
const FSVenueDetails = Vue.component('fs-venue-details',{
	props: {
		config: {
			type: Object,
			required: true
		}
	},
  	template:`  	
  		<div class="wrapper venue-details">
		  	<h4>Venue Details</h4>
		  	
		  	{{ config }}
  		</div>`
});

/**
 * Venues Near You
 */
const FSVenuesNearYou = Vue.component('fs-venues-near-you',{
	props: {
		config: {
			type: Object,
			required: true
		}
	},
	data(){
		return {
			venues: []
		}
	},
	created: function () {
    	this.getVenuesNearYou();
	},
	methods: {
		/**
    	 * @name getVenuesNearYou
    	 * @description Get venues near you
    	 */
		getVenuesNearYou() {
			
			// ES2017 async/await support
			const params = new URLSearchParams();
			params.append('action', 'get_venues_per_current_city');
			params.append('ll', this.config.latitude + "," + this.config.longitude);
			params.append('intent', 'checkin');
			
			axios.post('/', params).then((response) => {
				this.venues = response.data.response.venues;
			});
		}
	},
  	template:`  	
  		<div class="wrapper venues-near-you">
		  	<h4>Venues Near You</h4>
		  	
		  	<p v-show="!venues.length">Loading...</p>
		  	
		  	<ul>
		  		<li v-for="(venue, key) in venues">
		  		
  					<img class="icon float-left" v-for="category in venue.categories" v-bind:src="category.icon.prefix + '64' + category.icon.suffix" />
  					<span>in </span>
  					<span>{{ venue.location.distance }} </span>
  					<span>meters</span>
		  		
		  			<span>{{ venue.name }}</span>
		  			<span v-for="piece in venue.location.formattedAddress">{{ piece }}, </span>
		  			
		  			<p class="nmb">{{ key + 1 }}</p>
		  			
		  			<br />-------------------------------------<br />
		  		</li>
		  	</ul>
  		</div>`
});

/* *****************************************************************************************
 *  
 *  Main Components 
 *  
 *  
 */
/**
 * Sidebar
 */
const FSSidebar = Vue.component('fs-sidebar',{
	components: {
		FSCurrentLocation, 
		FSCategories
	},
	props: {
		config: {
			type: Object,
			required: true
		}
	},
  	template:`  	
  		<div class="wrapper sidebar">
		  	<h3>Sidebar</h3>
		  	
		  	<fs-current-location :config="config"></fs-current-location>
		  	<fs-categories :config="config"></fs-categories>
  		</div>`
});

/**
 * Content
 */
const FSContent = Vue.component('fs-content',{
	components: {
		FSVenueDetails, 
		FSVenuesNearYou
	},
	props: {
		config: {
			type: Object,
			required: true
		}
	},
  	template:`  	
  		<div class="wrapper content">
		  	<h3>Content</h3>
		  	
		  	<fs-venue-details :config="config"></fs-venue-details>
		  	<fs-venues-near-you :config="config"></fs-venues-near-you>
  		</div>`
});

/* *****************************************************************************************
 *  
 *  Vm is responsible for asking the permission to the users to get their coordinates 
 *  and set up the config object that will be pass to the other components.
 *  
 */
const vm = new Vue({
    el: '#foursquare-integration',
    components: {
        'fs-sidebar': FSSidebar,
        'fs-content': FSContent
    },
    data: {
    	config: {
    		latitude: 0,
    		longitude: 0,
    		accuracy: 0,
    		b_geolocation: false,
    	}
    },
    created: function () {
    	this.getCurrentPosition();
	},
    methods: {
    	/**
    	 * @name getCurrentPosition
    	 * @description Get the current position of the user and set up config variable if user geolocation is enabled.
    	 */
    	getCurrentPosition() {
			let options = {
					enableHighAccuracy: true,
					timeout: 5000,
					maximumAge: 0
				};
			return navigator.geolocation.getCurrentPosition( 
				this.getCurrentPositionSuccess, 
				this.getCurrentPositionError, options 
			);
		},
		/**
    	 * @name getCurrentPositionSuccess
    	 * @description In case of geolocalization enabled.
    	 */
		getCurrentPositionSuccess(pos) {
			var crd = pos.coords;
			
			this.config.latitude = crd.latitude;
			this.config.longitude = crd.longitude;
			this.config.accuracy = crd.accuracy;
			this.config.b_geolocation = true;
		},
		/**
    	 * @name getCurrentPositionError
    	 * @description In case of geolocalization disabled.
    	 */
		getCurrentPositionError(err) {
			this.b_geolocation = false;
			
			console.log( "Geolocalization disabled!" );
		},
    }
});