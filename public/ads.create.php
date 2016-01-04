<?php

require_once '../bootstrap.php';

if (Auth::check()) 
{
	if (Auth::user())
	{
		$username = Auth::user();
	}
}

function insertListing($dbc, $item_name, $price, $image, $description, $status = "active") 
{	
	$userId = Auth::id();

	$d = Input::getDate('now');

	$listing_date = $d->format('Y-m-d');

	$insert = "INSERT INTO ads(listing_date, item_name, price, image, description, status, user_id) 
		VALUES (:listing_date, :item_name, :price, :image, :description, :status, :user_id)";
	$stmt = $dbc->prepare($insert);
	$stmt->bindValue(':listing_date', $listing_date, PDO::PARAM_STR);
	$stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
	$stmt->bindValue(':price', $price, PDO::PARAM_INT);
	$stmt->bindValue(':image', $image , PDO::PARAM_STR);
	$stmt->bindValue(':description', $description, PDO::PARAM_STR);
	$stmt->bindValue(':status', $status, PDO::PARAM_STR);

	$stmt->bindValue(':user_id', $userId , PDO::PARAM_INT);
	// ask Reni what is the key?
	// $stmt->bindValue(':user_id', $_SESSION[''] , PDO::PARAM_INT);
	$stmt->execute();
}

function pageController($dbc) 
{
	$errors = array();

	try {
		$item_name = Input::getString('item_name');
	} catch (Exception $e) {
		$error = $e->getMessage();
		array_push($errors, $error);
	}
	try {
		$price = Input::getString('price');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try {
		$image = Input::getString('image');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
	try {
		$description = Input::getString('description');
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	} 
	 
	
	if(!empty($_POST))
	{
		// add inputed data into datebase
		if (Input::notEmpty('item_name') 
			&& Input::notEmpty('price') 
			&& Input::notEmpty('image') 
			&& Input::notEmpty('description')){

		// if no errors were thrown runs insert park
			if(empty($errors)) 
			{
				insertListing($dbc, $item_name, $price, $image, $description);
			} 
			// elseif (Input::notEmpty('deleted_item_name')) {
			// 	$deleteListing($dbc);
			// } 
			// else {
			// 	echo "Please make a valid entry.";
			// }				
			
		}

	}
}

pageController($dbc);

?>

<!doctype html>
<html lang="en">
<head>
	<?php require_once('../views/partials/head.php'); ?>
	<title>Creating Ad</title>
</head>
<body>
	<div class="container">
	<!-- 	<?php require_once('../views/partials/header.php') ?> -->
  	<?php require_once('../views/partials/navbar.php') ?>

		<div class="col-md-6"class= "form_users">
			<form method="POST" role="form" action="ads.create.php">

			<h2>Create a New Listing 
			<!-- 	<?= $username; ?> -->
			</h2>

	        	<div class="form-group">
	        		<label for="item_name">Item:</label>
	        			<input type="text" id="item_name" name="item_name" placeholder="Item Name" class="form-control">
	        		</div>
	        	</div>

	        	<div class="form-group">
	        		<label for="price">Price:</label>
	        			<input type="text" id="price" name="price" placeholder="Price in Dollars ($)" class="form-control">
	        		</div>
	        	</div>

	        	<div class="form-group">
	        		<label for="image">Image:</label>
	        		<span class="btn btn-default btn-file">Browse
	          			<input type="file" id="image" name="image" class="form-control" step="any" size="60">
	          		</span>
	          		</div>
	          	</div>

	          	<div class="form-group">
	          		<label for="description">Description:</label>
	          			<textarea id="description" name="description" placeholder="Description" row="5" class="form-control"></textarea>
	          		</div>
	          	</div>

	          	<div class="form-group">        
      				<div class="col-sm-offset-2 col-sm-10">
        				<input class="submit-button" type="submit" value="submit">
      				</div>
    			</div>	        	
   			</form>
   			
		</div>
	</div>
	<?php require_once '../views/partials/footer.php'; ?>
	<?php require_once '../views/partials/script.php'; ?>
</body>
</html>