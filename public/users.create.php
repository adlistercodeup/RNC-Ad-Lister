<?php

require_once '../bootstrap.php';
session_start();

function insertData($dbc) 
{
	$errors =[];
	if (!empty($_POST)) 
	{
		try {
			$userName = Input::getString('username');
		} catch (Exception $e) {
			$errors[] = $e->getMessage();		
		}

		try {
			$password = Input::getString('pwd');
			$password = password_hash($password, PASSWORD_DEFAULT);
		} catch (Exception $e) {
			$errors[] = $e->getMessage();		
		}

		try {
			$firstName = Input::getString('firstname');
		} catch (Exception $e) {
			$errors[] = $e->getMessage();		
		}

		try {
			$lastName = Input::getString('lastname');
		} catch (Exception $e) {

			$errors[] = $e->getMessage();		
		}

		try {
			$email = Input::getString('email');
		} catch (Exception $e) {
			$errors[] = $e->getMessage();		
		}

		try {
			$zipCode = Input::getNumber('zipcode');
		} catch (Exception $e) {
			$errors[] = $e->getMessage();		
		}

		if (Input::notEmpty('username') && Input::notEmpty('pwd') && Input::notEmpty('firstname') && Input::notEmpty('lastname') && Input::notEmpty('email') && Input::notEmpty('zipcode')) 
		{
				$userData = 'INSERT INTO user_account (first_name, last_name, user_name, password, email, zipcode)
							VALUES (:first_name, :last_name, :user_name, :password, :email, :zipcode)';

				$userStmt = $dbc->prepare($userData);
			
				$userStmt->bindValue(':first_name', $firstName, PDO::PARAM_STR);
				$userStmt->bindValue(':last_name', $lastName, PDO::PARAM_STR);
				$userStmt->bindValue(':user_name', $userName, PDO::PARAM_STR);
				$userStmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
				$userStmt->bindValue(':email', $email, PDO::PARAM_STR);
				$userStmt->bindValue(':zipcode', $zipCode, PDO::PARAM_INT);

				try {
					$userStmt->execute();
				} catch (Exception $e) {
					$errors[] = $e->getMessage();
				}
		}
	}
	return $errors;
}

insertData($dbc);

// function changePage(){
// 	header("Location: users.show.php");
// 	die();
// }

// changePage();
?>

<!doctype html>
<html lang="en">
<head>
	<?php require_once('../views/partials/head.php'); ?>
	<title>Create User</title>
</head>
<body>
	<div class="container">
	<?php require_once('../views/partials/header.php') ?> 
	<?php require_once('../views/partials/navbar.php') ?>
		<div class="col-md-6"class= "form_users">
			<form role="form" method="post" action="users.create.php">
	
			<h1>Welcome!!!</h1>

				<div class="form-group">
				    <label for="username">Username:</label>
				    	<input type="text" class="form-control" id="username" placeholder="Username" name="username" required autofocus>
		    	</div>

		    	<div class="form-group">
	      			<label for="pwd">Password:</label>
	      				<input type="password" class="form-control" id="pwd" required placeholder="Enter password" name="pwd">
	    		</div>

	    		<div class="form-group">
			      	<label for="firstname">Firstname:</label>
			      		<input type="text" class="form-control" id="firstname" placeholder="Firstname" name="firstname">
		    	</div>

		    	<div class="form-group">
			      	<label for="lastname">Lastname:</label>
			      		<input type="text" class="form-control" id="lastname" placeholder="Lastname" name="lastname">
		    	</div>

		    	<div class="form-group">
			      	<label for="email">Email:</label>
			      		<input type="email" class="form-control" id="email" placeholder="E-Mail" name="email">
		    	</div>

		    	<div class="form-group">
			      	<label for="zipcode">Zipcode:</label>
			      		<input type="number" pattern="[0-9]{5}" title="Five digit zipcode" class="form-control" id="zipcode" placeholder="Zipcode" name="zipcode">
		    	</div>

				<div class="checkbox">
	      			<label><input type="checkbox"> Remember me</label>
	    		</div>

		    	<div class="form-group">         
	                <input id="search" class="submit-button" type="submit" value="Submit">
	            </div>	
			</form>
		</div>

		<div class="col-md-6"class= "form_users">
			<form role="form" method="post" action="users.create.php">
				<h1 class="login">Already a Member?</h1>				
				<div>
					<a href="auth.login.php" class="login btn btn-default">Login</a>
				</div>
			</form>
		</div>
	<div>
		<?php include '../views/partials/footer.php'; ?>
	</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	</div>
</body>
</html>