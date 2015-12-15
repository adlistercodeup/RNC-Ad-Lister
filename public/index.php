




<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Adlister</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body>
	<div class="container">

		<?php include '../views/partials/navbar.php'; ?>

		<div>
			<form method="POST">
				<button name="create_a_post" type="submit">Sell Your Stuff</button>
			</form>
		</div>
		<div>
			<form method="POST" action = "login.php">
		        <label>Username</label>
		        <input type="text" name="username"><br>
		        <label>Password</label>
		        <input type="text" name="password"><br>
		        <button type="submit">Submit</button>
	    	</form>
		</div>

	<?php include '../views/partials/footer.php'; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/main.js"></script>

	</div>
</body>

</html>