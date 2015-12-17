<!-- listening to user input
including requires for classes -->
<!doctype html>
<html lang="en">
<head>
	<?php require_once('../views/partials/head.php'); ?>
	<title>Where treasures are found and shared.</title>
</head>

<body>
	<div class="container">

		<?php include '../views/partials/navbar.php'; ?>

		 <div id="myCarousel" class="carousel slide" data-ride="carousel">
		    <!-- Indicators -->
		    <ol class="carousel-indicators">
		      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		      <li data-target="#myCarousel" data-slide-to="1"></li>
		      <li data-target="#myCarousel" data-slide-to="2"></li>
		    </ol>

		    <!-- Wrapper for slides -->
		    <div class="carousel-inner" role="listbox">

		      	<div class="item active">
		        	<img src="img/home_page/mother.jpg" width="460" height="550">
				        <div class="carousel-caption">
					        <h3 class="testimonial">Surprise Baby #3! We found everything we needed to get ready at a fraction of the cost.</h3>
					        <h3 class="testimonial"><em>- Rebecca</em></h3>
			        	</div>
		    	</div>

		      	<div class="item">
		        	<img src="img/home_page/mother-and-baby.jpg" width="460" height="550">
			        	<div class="carousel-caption">
					        <h3 class="testimonial">We sold our gently used baby stuff for top dollar in no time!</h3>
					        <h3 class="testimonial"><em>- Alisa</em></h3>
			        	</div>
		      	</div>
			    
		      	<div class="item">
		        	<img src="img/home_page/toddler_twins.jpg" width="460" height="550">
			        	<div class="carousel-caption">
				          <h3 class="testimonial">"As fast as these two are growing there is NO WAY we could afford 2X's everything without Finders Keepers."</h3>
				          <h3 class="testimonial"><em>- Regina</em></h3>
				        </div>
		      	</div>

			</div>  

		  <!-- Left and right controls -->
			    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			      <span class="sr-only">Previous</span>
			    </a>
			    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			      <span class="sr-only">Next</span>
			    </a>
	</div>

		<div id="sell-stuff">
			<a href="ads.create.php" class="btn btn-default">Sell Your Stuff</a>
		</div>

		  

	<div id="footer">
		<?php include '../views/partials/footer.php'; ?>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>