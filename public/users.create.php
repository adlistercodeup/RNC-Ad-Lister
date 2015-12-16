<?php

require_once '../database/adlist_db_config.php';
require_once '../database/adlist_db_connect.php';

require_once "../utils/Input.php";


function insertData($dbc) {

	$errors =[];

	if (!empty($_POST)) {

		try {
			$username = Input::getString('username');
		} catch (Exception $e) {

			$errors[] = $e->getMessage();		
		}

		try {
			$password = Input::getString('password');

			$password = password_hash('$password');
		} catch (Exception $e) {

			$errors[] = $e->getMessage();		
		}

		try {
			$firstname = Input::getString('firstname');
		} catch (Exception $e) {

			$errors[] = $e->getMessage();		
		}

		try {
			$lastname = Input::getString('lastname');
		} catch (Exception $e) {

			$errors[] = $e->getMessage();		
		}

		try {
			$email = Input::getString('email');
		} catch (Exception $e) {

			$errors[] = $e->getMessage();		
		}

		try {
			$zipcode = Input::Number('zipcode');
		} catch (Exception $e) {

			$errors[] = $e->getMessage();		
		}


		f (Input::notEmpty('name') && Input::notEmpty('location')) {

				$userData = 'INSERT INTO national_parks (name, location, date_established, area_in_acres, description)
							VALUES (:name, :location, :date_established, :area_in_acres, :description)';


				$userStmt = $dbc->prepare($userData);
			
				$userStmt->bindValue(':name', $name, PDO::PARAM_STR);
				$userStmt->bindValue(':location', $location, PDO::PARAM_STR);
				$userStmt->bindValue(':date_established', $date, PDO::PARAM_STR);
				$userStmt->bindValue(':area_in_acres', $area, PDO::PARAM_STR);
				$userStmt->bindValue(':description', $description, PDO::PARAM_STR);

				try {

					$userStmt->execute();
					
				} catch (Exception $e) {


				$errors[] = $e->getMessage();
			

				throw new Exception('Error: {$e->getMessage()}');

				}

			}





	}



}





?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once('../views/partials/head.php'); ?>
	<title>Create User</title>
</head>
<body>
	<div class="container">
	<?php require_once('../views/partials/header.php') ?> 
	<?php require_once('../views/partials/navbar.php') ?>

	<h1>Welcome</h1>

		<!-- add first and last names and zip code -->
		<div class= "form_users">
			<form role="form" method="post" action="users.create.php">

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
			      <input title="Five digit zipcode" pattern="[0-9]{5}" type="number" class="form-control" id="email" placeholder="E-Mail" name="email">
		    	</div>

				<div class="checkbox">
	      			<label><input type="checkbox"> Remember me</label>
	    		</div>

		    	<div class="form-group">        
	              <div class="col-sm-offset-2 col-sm-10">
	                <input type="submit" value="Logout">
	              </div>
	          	</div>	
			</form>
		</div>

	<?php require_once('../views/partials/footer.php') ?>

	</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



</body>
</html>