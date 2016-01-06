<?php

// show profile details and member's listings

require_once '../bootstrap.php';


if (Auth::check()) 
{
	$username = Auth::user();
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
 
	<?php require_once('../views/partials/navbar.php') ?>

	<h1 id="welcome">Welcome Back, <?= $username; ?> !!!</h1>

		<div id="sell-stuff">
				<a href="ads.create.php" class="btn btn-default">Sell Your Stuff</a>
				<a href="ads.index.php" class="btn btn-default">SHOP</a>
				<a href="users.edit.php" class="btn btn-default">Edit My Profile</a>
		</div>


	</div>
<?php require_once '../views/partials/footer.php'; ?>
<?php require_once '../views/partials/script.php'; ?>
</body>
</html>
