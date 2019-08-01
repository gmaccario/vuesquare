<div id="foursquare-integration" class="container-fluid">
	<div class="wrapper">
	
		<div v-if="!config.b_geolocation">
			<p>@todo Manual search</p>
		</div>
		<div v-else>
            <div class="row">
            	<div class="col-sm-4">
            		<fs-sidebar :config="config"></fs-sidebar>
            	</div>
            	<div class="col-sm-8">
            		<fs-content :config="config"></fs-content>
            	</div>
            </div>
		</div>		
	</div>
</div>