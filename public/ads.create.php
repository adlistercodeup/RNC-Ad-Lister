<?php
require_once '../database/adlist_db_config.php';
require_once '../database/adlist_db_connect.php';
// require_once '../utils/Input.php';
require_once '../utils/Auth.php';

if (Auth::check()) {
	if (Auth::user()){
		$username = Input::get('username');
	}
}


function insertListing($dbc, $listing_date, $item_name, $price, $image, $description) {
	var_dump($listing_date);
	$insert = "INSERT INTO ads(listing_date, item_name, price, image, description, status, user_id) 
		VALUES (:listing_date, :item_name, :price, :image, :description, :status, :user_id)";
	$stmt = $dbc->prepare($insert);
	$stmt->bindValue(':listing_date', $listing_date, PDO::PARAM_STR);
	$stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
	$stmt->bindValue(':price', $price, PDO::PARAM_INT);
	$stmt->bindValue(':image', $image , PDO::PARAM_STR);
	$stmt->bindValue(':description', $description, PDO::PARAM_STR);
	$stmt->bindValue(':status', $status, PDO::PARAM_STR);

	$stmt->bindValue(':user_id', 3 , PDO::PARAM_INT);
	// ask Reni what is the key?
	// $stmt->bindValue(':user_id', $_SESSION[''] , PDO::PARAM_INT);
	$stmt->execute();
}

function pageController($dbc) {
	$errors = array();

	// this block checks to see if an error is going to be thrown
	try {
		$listing_date = new DateTime();
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}
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
	 
	
	if(!empty($_POST)){
		// add inputed data into datebase
		if (Input::notEmpty('listing_date') 
			&& Input::notEmpty('item_name') 
			&& Input::notEmpty('price') 
			&& Input::notEmpty('image') 
			&& Input::notEmpty('description')){

			if (Input::get('status') === 'active') {

		// if no errors were thrown runs insert park
				if(empty($errors)) {
					insertListing($dbc, $listing_date, $item_name, $price, $image, $description);
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
	
		<div>
			<h2>Signed in as <?//= $username; ?> !</h2>
		</div>

		<div>
			<form method="POST" role="form" action="ads.create.php">

				<div class="form-group">
					<label for="listing_date" class="control-label col-sm-2">Date:</label>
					 <div class="col-sm-10">
	        			<input type="date" id="listing_date" name="listing_date" placeholder="Listing Date" class="form-control">
	        		</div>
	        	</div>

	        	<div class="form-group">
	        		<label for="item_name" class="control-label col-sm-2">Item:</label>
	        		<div class="col-sm-10">
	        			<input type="text" id="item_name" name="item_name" placeholder="Item Name" class="form-control">
	        		</div>
	        	</div>

	        	<div class="form-group">
	        		<label for="price" class="control-label col-sm-2">Price:</label>
	        		<div class="col-sm-10">
	        			<input type="text" id="price" name="price" placeholder="Price in Dollars ($)" class="form-control">
	        		</div>
	        	</div>

	        	<div class="form-group">
	        		<label for="image" class="control-label col-sm-2">Image:</label>
	        		<div class="col-sm-10">
	          			<input type="text" id="image" name="image" placeholder="Image" class="form-control" step="any">
	          		</div>
	          	</div>

	          	<div class="form-group">
	          		<label for="description" class="control-label col-sm-2">Description:</label>
	          		<div class="col-sm-10">
	          			<textarea id="description" name="description" placeholder="Description" row="5" class="form-control"></textarea>
	          		</div>
	          	</div>

	          	<!-- <div class="form-group">
	          		<label for="status" class="control-label col-sm-2">Status:</label>
	          		<div class="col-sm-10">
	          			<input list="status" id="status" name="status" placeholder="status" class="form-control">
	          			<datalist id="status">
	          				<option value="active">
	          				<option value="inactive">
	          				<option value="free">
	          			</datalist>
	          		</div>
	          	</div> -->

	          	<div class="form-group">        
      				<div class="col-sm-offset-2 col-sm-10">
        				<input type="submit" value="submit">
      				</div>
    			</div>	        	
   			</form>
		</div>
	</div>
</body>
</html>