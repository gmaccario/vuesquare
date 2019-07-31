<div id="foursquare-integration">
	<div class="wrapper col-4 float-left">
	
		<div v-if="!config.b_geolocation">
			<p>@todo Manual search</p>
		</div>
		<div v-else>
			<fs-sidebar :config="config"></fs-sidebar>
			<fs-content :config="config"></fs-content>
		</div>		
	</div>
</div>