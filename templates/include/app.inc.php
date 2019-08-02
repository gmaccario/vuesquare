<div id="foursquare-integration" class="container-fluid">
	<div class="wrapper">
	
		<div v-if="!b_geolocation">
			<h2>@todo Manual search</h2>
		</div>
		<div v-else>
            <div class="row">
            	<div class="col-sm-4">
            		<fs-sidebar :config="config" :categories="categories"></fs-sidebar>
            	</div>
            	<div class="col-sm-8">
            		<fs-content :config="config" :venues="venues" :venue="venue"></fs-content>
            	</div>
            </div>
		</div>		
	</div>
</div>