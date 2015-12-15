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

		<div id="nav-background">
			<div>
				<a href="ads.create.php" class="btn btn-default">Sell Your Stuff</a>
			</div>
		</div>
		<br>
		<div>
			<div>
				<p>Already a Member?</p>
				<form method="POST" action = "login.php">
			        <label>Username</label>
			        <input type="text" name="username"><br>
			        <label>Password</label>
			        <input type="text" name="password"><br>
			        <button type="submit">Submit</button>
		    	</form>
	    	</div>
	    	<br>
	    	<a href="users.create.php" class="btn btn-default">
	    		Create a Profile
	    	</a>
		</div>

	<?php include '../views/partials/footer.php'; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/main.js"></script>

	</div>
</body>

</html>