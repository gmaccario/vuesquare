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
			// @note Reverse Geocoding
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
		  	<h3>Current Location</h3>
		  	
		  	<div class="welcome">
		  		<span v-show="!location_name">Loading...</span>
		  	
		  		<i class="fa fa-map-marker float-left" aria-hidden="true"></i>
		  		
		  		<div class="location" v-show="location_name">
  					<span>You are in </span>
  					<span>{{ location_name }}</span>
  					<span> - </span>
  					<span v-if="location.city">{{ location.city }}</span>
  					<span v-if="location.city">, </span>
  					<span>{{ location.country }}</span>
  					<span> </span>
  					<span>({{ location.cc }})</span>
		  		</div>
		  	</div>
		  	
		  	<div class="where-i-am">
			  	<p>Here your precise location:</p>
			  	<ul>
			  		<li><span class="label">Latitude: </span><span class="value">{{ config.latitude }}</span></li>
			  		<li><span class="label">Longitude: </span><span class="value">{{ config.longitude }}</span></li>
			  		<li><span class="label">Accuracy: </span><span class="value">&cong; {{ parseInt(config.accuracy) }} meters</span></li>
			  	</ul>
  			</div>
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
		},
		categories: {
			type: Array,
			required: true
		}
	},
	data(){
		return {
			current: this.$root.$data.category
		}
	},
	created: function () {
		
	},
	methods: {
    	
    	/**
    	 * @name getVenuesByCategory
    	 * @description Get the list of venue by category
    	 */
    	getVenuesByCategory(category_id) {
    		
    		this.current = category_id;
    		
    		// ES2017 async/await support
			const params = new URLSearchParams();
			params.append('action', 'get-venues-by-category');
			params.append('ll', this.config.latitude + "," + this.config.longitude);
			params.append('categoryId', this.current);
			params.append('intent', 'checkin');
			
			axios.post('/', params).then((response) => {				
				
				this.$root.$data.venues = response.data.response.venues;
				this.$root.$data.venue = {};
			});
			
    		//this.$emit('get-venues-by-category');
    	}
	},
  	template:`  	
  		<div class="wrapper categories">
		  	<h3>Categories</h3>
		  	
  			<p v-show="!categories.length">Loading...</p>
  			
		  	<div class="row" v-for="category in categories">
				<div class="col-4">
					<a href="#" @click="getVenuesByCategory(category.id);">
						<img :src="category.icon.prefix + '32' + category.icon.suffix" />
					</a>
				</div>
				<div class="col-8">
					<a href="#" @click="getVenuesByCategory(category.id);">
						<span class="shortName" :class="(current == category.id) ? 'current' : ''">
							{{ category.shortName }}
						</span>
					</a>
				</div>
			</div>
  		</div>`
});

/**
 * Venue Details
 */
const FSVenueDetails = Vue.component('fs-venue-details',{
	props: {
		venue: {
			type: Object,
			required: true
		}
	},
  	template:`  	
  		<div class="wrapper venue-details" v-if="venue.error || venue.id">
		  	<h3>Venue Details</h3>
		  	
		  	<div class="details">
		  	
			  	<p class="error" v-if="venue.error">
			  		<span v-if="venue.error == 429">Free account here! Currently over the daily call quota limit (950 calls per day).</span>
			  	</p>
		  	
				<div v-if="!venue.error">
				  	<div class="row">
            			<div class="col-4">
							<div class="venue best-photo">
								<img class="icon" 
									v-if="venue.bestPhoto" 
									v-bind:src="venue.bestPhoto.prefix + '64' + venue.bestPhoto.suffix" 
									:alt="venue.name" 
									:title="venue.name" />
									
								<img class="icon" 
									v-if="!venue.bestPhoto" 
									src="https://via.placeholder.com/64" 
									:alt="venue.name" 
									:title="venue.name" />
							</div>

							<div class="contact">
								<a :href="'tel:' + venue.contact.phone" :show="venue.contact.phone">
									<i class="fa fa-phone" aria-hidden="true"></i>
								</a>
								
								<a :href="'https://www.facebook.com/profile.php?id=' + venue.contact.facebook" target="_blank" :show="venue.contact.facebook">
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</a>
								
								<a :href="'https://twitter.com/' + venue.contact.twitter" v-if="venue.contact.twitter" target="_blank" :show="venue.contact.twitter">
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</a>
							</div>
						</div>

						<div class="col-8">
							<h5 class="text-right">
								<a :href="venue.shortUrl" target="_blank">
									<span>{{ venue.name }}</span>
								</a>
							</h5>
							
							<h6 class="text-right" v-if="venue.categories[0]" >
								<i v-if="venue.verified" class="fa fa-check verified" aria-hidden="true" alt="Verified" title="Verified"></i>
								{{ venue.categories[0].name }}
							</h6>
							
							<div class="address text-right">
								<span v-if="venue.location.address">{{ venue.location.address }}</span>
								<span v-if="venue.location.address"><br /></span> 
								<span v-if="venue.location.city">{{ venue.location.city }}</span>
								<span v-if="venue.location.city">-</span> 
								<span v-if="venue.location.state">{{ venue.location.state }}</span> 
								<span v-if="venue.location.state">-</span>
								<span v-if="venue.location.country">{{ venue.location.country }}</span> 
							</div>
							
							<div class="likes text-right" :show="venue.likes.count > 0">
								<span class="value">{{ venue.likes.count }}</span>
								<span> </span>
								<span class="label">likes</span>
							</div>
							
							<div class="rating text-right" :show="venue.likes.rating > 0">
								<span class="label">Rating</span>
								<span> </span>
								<span class="value">{{ venue.rating }}</span>
							</div>
							
							<div class="other text-right" :show="venue.hereNow.count > 0">
								<span class="alert alert-success hereNow">
									<i aria-hidden="true" class="fa fa-star"></i> 
									<span>{{ venue.hereNow.summary }}</span>
								</span>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="tips text-left" :show="venue.tips.count > 0">
								<p>
									<span>Tips: </span>
									<span>{{ venue.tips.groups[0].items[0].text }}</span>
								</p>
								
								<span>{{ venue.tips.groups[0].items[0].likes.summary }}</span>
							</div>
						</div>
					</div>
		  		</div>
		  	</div>
  		</div>`
});

/**
 * Venues Near You
 */
const FSVenuesNearYou = Vue.component('fs-venues-near-you',{
	props: {
		venues: {
			type: Array,
			required: true
		}
	},
	data(){
		return {
			current: this.$root.$data.venue
		}
	},
	created: function () {
		
	},
	methods: {
		
		/**
    	 * @name getVenueById
    	 * @description Get venues near you
    	 */
		getVenueById(venue_id) {
			
			this.current = venue_id;

    		// ES2017 async/await support
			const params = new URLSearchParams();
			params.append('action', 'get-venue-details');
			params.append('id_venue', this.current);
			params.append('intent', 'checkin');
			
			axios.post('/', params).then((response) => {				
				
				if(response.data.meta.code != 429){
					this.$root.$data.venue = response.data.response.venue;
				}
				else {
					Vue.set(this.$root.$data.venue, 'error', response.data.meta.code);
				}
			});

    		//this.$emit('get-venue-by-id');
		}
	},
  	template:`  	
  		<div class="wrapper venues-near-you">
		  	<h3>Venues Near You</h3>
		  	
		  	<p v-show="!venues.length">Loading...</p>
			
			<div class="row" v-for="(venue, index) in venues">
				  
				<div class="col-4">
					<div class="category icon">
						<img class="icon" 
							v-if="venue.categories[0]" 
							v-bind:src="venue.categories[0].icon.prefix + '64' + venue.categories[0].icon.suffix" 
							alt="venue.categories[0].name" 
							:title="venue.categories[0].name" />
							
						<img class="icon" 
							v-if="!venue.categories[0]" 
							src="https://via.placeholder.com/64" 
							alt="No category" 
							title="No category" />
					</div>
				
					<div class="distance">
						<span>in </span>
						<span>{{ venue.location.distance }} </span>
						<span>meters</span>
					</div>
				</div>

				<div class="col-8 details">
					<h4 class="text-right">
						<a href="#" @click="getVenueById(venue.id);">
							<span>{{ venue.name }}</span>
						</a>
					</h4>
					
					<h6 class="text-right" v-if="venue.categories[0]" >{{ venue.categories[0].name }}</h6>
					
					<div class="address text-right">
						<span v-if="venue.location.address">{{ venue.location.address }}</span>
						<span v-if="venue.location.address"><br /></span> 
						<span v-if="venue.location.city">{{ venue.location.city }}</span>
						<span v-if="venue.location.city">-</span> 
						<span v-if="venue.location.state">{{ venue.location.state }}</span> 
						<span v-if="venue.location.state">-</span>
						<span v-if="venue.location.country">{{ venue.location.country }}</span> 
					</div>
					
					<div class="other text-right">
						<span v-if="venue.hereNow.count > 0" class="alert alert-success hereNow">
							<i aria-hidden="true" class="fa fa-star"></i> 
							<span>{{ venue.hereNow.summary }}</span>
						</span>
					</div>
				</div>
				
				<div class="col-12">
					<div class="text-right">
						<p class="nmb">{{ index + 1 }}</p>
					</div>
				</div>
			</div>
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
		},
		categories: {
			type: Array,
			required: true
		}
	},
	method: {

	},
  	template:`  	
  		<div class="wrapper sidebar">
		  	<fs-current-location :config="config"></fs-current-location>
		  	<fs-categories :config="config" :categories="categories"></fs-categories>
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
		},
		venues: {
			type: Array,
			required: true
		},
		venue: {
			type: Object,
			required: true
		}
	},
	method:{},
  	template:`  	
  		<div class="wrapper content">
		  	<fs-venue-details :venue="venue"></fs-venue-details>
		  	<fs-venues-near-you :venues="venues"></fs-venues-near-you>
  		</div>`
});

/* *****************************************************************************************
 *  
 *  Vm is responsible to get the coordinates to the users and set up the config object 
 *  that will be pass to the other components.
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
    		accuracy: 0
    	},
    	
    	b_geolocation: false,
    	
    	categories: [],
    	category: 0,

		venues: [],    	
		venue: {}
    },
    watch: {
    	b_geolocation: function (geolocation) {
    		if(geolocation)
			{
    			this.getCategories();
    			this.getVenuesNearYou();
			}
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

			this.b_geolocation = true;
		},
		/**
    	 * @name getCurrentPositionError
    	 * @description In case of geolocalization disabled.
    	 */
		getCurrentPositionError(err) {
			
			this.b_geolocation = false;
			
			console.log("Geolocalization disabled!");
		},
		
		/**
    	 * @name getCategories
    	 * @description Get categories
    	 */
		getCategories() {
			
			// ES2017 async/await support
			const params = new URLSearchParams();
			params.append('action', 'get-categories');
			params.append('ll', this.config.latitude + "," + this.config.longitude);
			params.append('intent', 'checkin');
			
			axios.post('/', params).then((response) => {
				this.categories = response.data.response.categories;
			});
    	},
    	
    	/**
    	 * @name getVenuesNearYou
    	 * @description Get venues near you
    	 */
		getVenuesNearYou() {
			
			// ES2017 async/await support
			const params = new URLSearchParams();
			params.append('action', 'get-venues-per-current-city');
			params.append('ll', this.config.latitude + "," + this.config.longitude);
			params.append('intent', 'checkin');
			
			axios.post('/', params).then((response) => {				
				this.venues = response.data.response.venues;
				this.venue = {};
			});
		},
    }
});