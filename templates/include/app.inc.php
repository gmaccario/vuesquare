<div id="foursquare-integration" class="container-fluid">
	<div class="wrapper">
		<div v-if="!geolocation_enabled">
			<div class="row">
				<div class="col-sm-12">
					<fs-manual-search></fs-manual-search>
					
					<?php 
					/*
					 * 
					 * <div class="wrapper content">
            		  	<fs-venues-near-you :config="config" :geolocation_enabled="geolocation_enabled"></fs-venues-near-you>
              		</div>
					 * 
					 * */
					?>
				</div>
			</div>
		</div>
		<div v-else>
			<div class="row">
            	<div class="col-sm-4">
            		<fs-sidebar :config="config" :geolocation_enabled="geolocation_enabled"></fs-sidebar>
            	</div>
            	<div class="col-sm-8">
            		<fs-content :config="config" :geolocation_enabled="geolocation_enabled"></fs-content>
            	</div>
        	</div>
		</div>
	</div>
</div>