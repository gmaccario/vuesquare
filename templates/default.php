<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' id='font-awesome.min-css' media='all' />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" />
	<link rel="stylesheet" href="<?php echo FTI_URL_CSS; ?>style.css" />
    
    <title>PHP 7, Foursquare API, Vue.js, Axios, Bootstrap</title>
  </head>
  <body>
    <div class="container">
	  	<div class="row">
		    <div class="col-12">
		    	<header>
    			    <h1 class="col-4 float-left">
    				  <a href="/">
    				    <img src="<?php echo FTI_URL_IMAGES; ?>logo.png" class="logo" alt="Foursquare API" />
    				  </a>
    				</h1>
    				
    				<h2 class="col-8 float-right">PHP 7, Foursquare API, Vue.js, Axios, Bootstrap</h2>
    				
    				<div class="clearfix"></div>
    			</header>

				<hr />
				
				<section>				
					<?php include( FTI_PATH_TEMPLATES_INCLUDE . 'app.inc.php' ); ?>
					
					<div class="clearfix"></div>
				</section>
				
				<hr />
				
				<footer class="text-right">
					<span>Powered by <a href="https://www.linkedin.com/in/giuseppemaccario/" target="_blank">G.Maccario</a></span>
					
					<div class="clearfix"></div>
				</footer>
			</div>
		</div>
	</div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

	<script src="<?php echo FTI_URL_JS; ?>foursquare-vue.js"></script>
  </body>
</html>