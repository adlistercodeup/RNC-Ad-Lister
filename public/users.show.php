<?php

// show profile details and member's listings

require_once "../utils/Auth.php";
require_once "../utils/Input.php";

session_start();

while (Auth::check()) {


	$username = Auth::user();

	var_dump($username);
	
}


?>
<!doctype html>
<html lang="en">
<head>
	<?php require_once('../views/partials/head.php'); ?>
	<title>Member Profile</title>
</head>
<body>
	<div class="container">
	<?php require_once('../views/partials/header.php') ?> 
	<?php require_once('../views/partials/navbar.php') ?>

	<h1 id="welcome">Welcome Back, !!!</h1>

	<div id="sell-stuff">
			<a href="ads.create.php" class="btn btn-default">Sell Your Stuff</a>
			<a href="ads.index.php" class="btn btn-default">SHOP</a>
			<a href="users.edit.php" class="btn btn-default">Edit My Profile</a>
	</div>


</body>

	</div>
	<div id="footer">
		<?php include '../views/partials/footer.php'; ?>
	</div>
</html>
