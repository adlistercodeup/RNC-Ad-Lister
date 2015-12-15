<?php
?>

<!DOCTYPE html>
<html>
<head>
	<?php require_once('../views/partials/head.php'); ?>
</head>
<?php require_once('../views/partials/header.php') ?> 
<?php require_once('../views/partials/navbar.php') ?>
<body>

	<h1>Become a Member</h1>

	<div class= "form_users">
		<form>
			<input type="text" id="username" name="username" placeholder="Username">
			<br>
			<input type="text" id="email" name="email" placeholder="Email">
			<br>
			<input type="password" id="password" name="password" placeholder="Password">
			<br>
			<input type="password" id="password" name="password" placeholder="Confirm Password"> 
			<br>
			<button type="submit">Submit</button>
		</form>
	</div>

<?php require_once('../views/partials/footer.php') ?>

</body>


</html>