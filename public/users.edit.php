<?php

require_once '../bootstrap.php';

if (Auth::check())
{
	if (Auth::user()) 
	{
		$username = Auth::user();
		$userId = Auth::id();
	}
}

function databaseData($dbc)
{ 
	$userId = Auth::id();

	$userData = "SELECT * FROM user_account where id =" . $userId;

	$stmt = $dbc->query($userData);

	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;
}

$results = databaseData($dbc);

foreach($results as $result)
{
	$databaseUsername = $result['user_name'];
	$databaseFirstname = $result['first_name'];
	$databaseLastname = $result['last_name'];
	$databaseEmail = $result['email'];
	$databaseZipcode = $result['zipcode'];	
}


function updateData($dbc) 
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
			// create new instance of user class
			$user = new User;

				$user->first_name = $firstName;
				$user->last_name = $lastName;
				$user->user_name = $userName;
				$user->email = $email;
				$user->zipcode = $zipCode;

			$user->save();

			$_SESSION['logInMessage'] = "Your profile has been updated.!!!";

			header("Location:index.php");
			die();

				
		}
	}
	return $errors;
}
updateData($dbc);
?>

<!doctype html>
<html lang="en">
<head>
<?php require_once('../views/partials/head.php'); ?>
	<title>Create User</title>
</head>
<body>
	<div class="container">
	<?php require_once('../views/partials/navbar.php') ?>
			
		<h1>Edit the information you want to change below!!!</h1>

		<div class="col-md-6"class= "form_users">
			<form role="form" method="post" action="users.edit.php">
	

				<div class="form-group">
				    <label for="username">Username:</label>
				    	<input value="<?= $databaseUsername; ?>" type="text" class="form-control" id="username" name="username" >
		    	</div>

	    		<div class="form-group">
			      	<label for="firstname">Firstname:</label>
			      		<input value="<?= $databaseFirstname; ?>" type="text" class="form-control" id="firstname" name="firstname">
		    	</div>

		    	<div class="form-group">
			      	<label for="lastname">Lastname:</label>
			      		<input value="<?= $databaseLastname; ?>" type="text" class="form-control" id="lastname" name="lastname">
		    	</div>

		    	<div class="form-group">
			      	<label for="email">Email:</label>
			      		<input value="<?= $databaseEmail; ?>" type="email" class="form-control" id="email" name="email">
		    	</div>

		    	<div class="form-group">
			      	<label for="zipcode">Zipcode:</label>
			      		<input value="<?= $databaseZipcode; ?>" type="number" pattern="[0-9]{5}" title="Five digit zipcode" class="form-control" id="zipcode" name="zipcode">
		    	</div>

		    	<div class="form-group">         
	                <input id="search" class="submit-button" type="submit" value="Submit">
	            </div>	
			</form>
		</div>

		

	</div>
<?php require_once '../views/partials/footer.php'; ?>
<?php require_once '../views/partials/script.php'; ?>
</body>
</html>