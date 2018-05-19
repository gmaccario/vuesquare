<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" />
	<link rel="stylesheet" href="<?php echo FTI_URL_CSS; ?>style.css" />
    <title>Challenge: Foursquare API, PHP, Vue.js, JQuery, Bootstrap</title>
  </head>
  <body>
    <div class="container">
	  	<div class="row">
		    <div class="col-12">
			    <h1 class="float-left">
				  <a href="/">
				    <img src="<?php echo FTI_URL_IMAGES; ?>logo.png" class="logo" alt="Foursquare API Challenge" />
				  </a>
				</h1>

				<h2 class="float-right">Foursquare API, PHP, Vue.js, JQuery, Bootstrap</h2>  
				
				<div class="clearfix"></div>
				
				<hr />
				
				<div id="app">
					<div class="wrapper col-4 float-left" v-if="b_geolocation === true && show_form === false">
						<div class="wrapper">
							<div v-if="s == false">
								<p class="message loading">Loading...</p>
							</div>
							<div v-else id="success">
								<img class="float-left" src="<?php echo FTI_URL_IMAGES; ?>google-maps-marker.png" alt="You are here!"  />
								<p>Your Current Location:</p>
								<ul class="current location">
									<li>Latitude: {{ latitude }}</li>
									<li>Longitude: {{ longitude }}</li>
									<li>Accuracy: more or less {{ accuracy }} meters.</li>
									<lI>Your current city: {{ current_city }}</li>
								</ul>
							</div>
						</div>

						<div class="clearfix"></div>
					</div>
					<div class="col-4 float-left" v-else-if="b_geolocation === false && show_form === true">
						<div class="wrapper">
							<h2>Search for locations near:</h2>
		
							<form name="locator" method="post" action="/" >
								<input name="t" type="hidden" value="t" />
					
								<input type="search" name="searchLocator" placeholder="Enter City Name" class="form-control" v-model="searchLocator" />
								
								<button type="submit" class="btn btn-aqua float-left" v-on:click="searchByAddressZipCodeOrCity( $event );">Find</button>
							</form>
						</div>
					</div>
					
					<div class="wrapper col-8 float-right" v-if="open_details != false && b_geolocation === true">
						<h2>Venue details</h2>
						<div v-if="sVenue == false">
							<p class="message loading">Loading...</p>
						</div>
						<div v-else>
							<ul class="venue details">
								<li class="icon">
									<img class="icon float-left" v-bind:src="venue_details[0].categories[0].icon.prefix + '64' + venue_details[0].categories[0].icon.suffix" />
								</li>
								<li class="name">
									<a v-bind:href="venue_details[0].canonicalUrl" target="_blank">
										{{ venue_details[0].name }}
									</a>
								</li>
								<li class="address">
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
							<h2>Venues near you</h2>
							<ul class="venues">
								<li class="item" v-if="venue.categories[0] != undefined" v-for="venue in venues">
									<img class="icon float-left" v-bind:src="venue.categories[0].icon.prefix + '64' + venue.categories[0].icon.suffix" />
									<div class="info">
										<span class="shortName">{{ venue.categories[0].shortName }}</span>
										<br />
										<span class="Name">
											<a href="#" v-on:click="openVenueDetails(venue.id);">{{ venue.name }}</a>
										</span>
										<br />
										<span class="id">{{ venue.id }}</span>
									</div>
									
									<div class="clearfix"></div>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="clearfix"></div>
				
				<div class="footer">
					<span class="float-right">Powered by <a href="https://www.linkedin.com/in/giuseppemaccario/" target="_blank">G.Maccario</a></span>
					
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="<?php echo FTI_URL_JS; ?>custom.js"></script>
  </body>
</html>