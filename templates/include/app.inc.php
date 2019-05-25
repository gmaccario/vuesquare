<div id="app">
	<div class="wrapper col-4 float-left" v-if="b_geolocation === true">
		<div class="wrapper">
			<div v-if="s == false">
				<p class="message loading">Loading...</p>
			</div>
			<div v-else id="success">
				<img class="float-left" src="<?php echo FTI_URL_IMAGES; ?>google-maps-marker.png" alt="You are here!"  />
				<p>Your Current Location:</p>
				<ul class="current location">
					<li>
						<span class="label">Your current city</span> <span class="value">{{ current_city }}</span>
					</li>
					<li>
						<span class="label">Latitude</span> 
						<span class="value">{{ latitude }}</span>
					</li>
					<li>
						<span class="label">Longitude</span>
						<span class="value">{{ longitude }}</span>
					</li>
					<li>
						<span class="label">Accuracy</span>
						<span class="value">&cong; {{ accuracy }} meters</span>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="clearfix"></div>
		
		<hr />
		
		<div v-if="s == false">
			<p class="message loading">Loading...</p>
		</div>
		<div v-else>
			<div v-if="code == 200">
				<div class="categories main-nav">
					<h2>Categories of venues near you</h2>
					<ul class="categories">
						<li class="item" v-if="category.name != undefined" v-for="category in categories">
							<div class="info">
								<span class="Name">
									<a href="#" v-on:click="openCategoryDetails(category.id);">{{ category.name }}</a>
								</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
	<div class="col-4 float-left" v-else-if="b_geolocation === false">
		<div class="wrapper">
			<h2>Search for locations near:</h2>

			<form name="locator" method="post" action="/" >
				<input name="t" type="hidden" value="t" />
	
				<input type="search" name="searchLocator" placeholder="Enter City Name" class="form-control" v-model="searchLocator" />
				
				<button type="submit" class="btn btn-aqua float-left" v-on:click="searchByAddressZipCodeOrCity( $event );">Find</button>
			</form>
		</div>
	</div>
	
	<div class="wrapper col-8 float-right" v-if="venue_details[0]">
		<h2>Venue details</h2>
		<div v-if="!venue_details[0]">
			<p class="message loading">Loading...</p>
		</div>
		<div v-else>
			<ul class="venue details">
				<li class="icon">
					<img class="icon float-left" v-bind:src="venue_details[0].categories[0].icon.prefix + '64' + venue_details[0].categories[0].icon.suffix" />
				</li>
				<li class="name">
					<span class="Name">
						<a v-bind:href="venue_details[0].canonicalUrl" target="_blank">{{ venue_details[0].name }}</a> -  
						<span class="shortName">{{ venue_details[0].categories[0].shortName }}</span> - 
						<span class="id">{{ venue_details[0].id }}</span>
					</span>
				</li>
				<li class="photo">
					<li class="item" v-for="photo in photos">
						<a v-bind:href="venue_details[0].canonicalUrl" target="_blank">
							<img class="icon float-left" v-bind:src="photo.prefix + '64' + photo.suffix" />
						</a>
					</li>
				</li>
				<li class="address">
					<span v-if="venue_details[0].location.address">{{ venue_details[0].location.address }}</span>
					<span v-if="venue_details[0].location.address"><br /></span> 
					<span v-if="venue_details[0].location.city">{{ venue_details[0].location.city }}</span>
					<span v-if="venue_details[0].location.city">-</span> 
					<span v-if="venue_details[0].location.state">{{ venue_details[0].location.state }}</span> 
					<span v-if="venue_details[0].location.state">-</span>
					<span v-if="venue_details[0].location.country">{{ venue_details[0].location.country }}</span> 
				</li>
				<li class="likes float-right" v-if="venue_details[0].likes.count > 0">
					<span>Like: </span>
					<span>{{ venue_details[0].likes.count }}</span>
				</li>
				<li class="likes float-right" v-else>
					<span>No likes yet!</span>
				</li>
				<li class="clearfix">&nbsp;</li>
			</ul>
		</div>
	</div>
	
	<div class="wrapper col-8 float-right">
		<div v-if="s == false">
			<p class="message loading">Loading...</p>
		</div>
		<div v-else>
			<div v-if="code >= 400">
				<p>{{ errorDetail }}</p>
			</div>
			<div v-else>
				<h2>Venues near you</h2>
				
				<ul class="venues">
					<li class="item" v-if="venue.categories[0] != undefined" v-for="venue in venues">
						<img class="icon float-left" v-bind:src="venue.categories[0].icon.prefix + '64' + venue.categories[0].icon.suffix" />
						<div class="info">
							<span class="Name">
								<a href="#" v-on:click="openVenueDetails(venue.id);">{{ venue.name }}</a> - 
								<span class="shortName">{{ venue.categories[0].shortName }}</span> - 
								<span class="id">{{ venue.id }}</span>
							</span>
							<br />
							<div class="address">
								<span v-if="venue.location.address">{{ venue.location.address }}</span>
								<span v-if="venue.location.address"><br /></span> 
								<span v-if="venue.location.city">{{ venue.location.city }}</span>
								<span v-if="venue.location.city">-</span> 
								<span v-if="venue.location.state">{{ venue.location.state }}</span> 
								<span v-if="venue.location.state">-</span>
								<span v-if="venue.location.country">{{ venue.location.country }}</span> 
							</div>
						</div>
						
						<div class="clearfix"></div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>