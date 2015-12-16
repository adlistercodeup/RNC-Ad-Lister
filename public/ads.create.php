<?php
require_once '../database/adlist_db_config.php';
require_once '../database/adlist_db_connect.php';
require_once '../utils/Input.php';


function insertListing($dbc, $listing_date, $item_name, $price, $image, $description) {
	
	$insert = "INSERT INTO ads(listing_date, item_name, price, image, description) 
		VALUES (:listing_date, :item_name, :price, :image, :description)";
	$stmt = $dbc->prepare($insert);
	$stmt->bindValue(':listing_date', $listing_date, PDO::PARAM_STR);
	$stmt->bindValue(':item_name', $item_name, PDO::PARAM_STR);
	$stmt->bindValue(':price', $price, PDO::PARAM_STR);
	$stmt->bindValue(':image', $description , PDO::PARAM_STR);
	$stmt->bindValue(':description', $image, PDO::PARAM_INT);
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
			&& Input::notEmpty('description') ){
				
		// if no errors were thrown runs insert park
			if(empty($errors)) {
				insertListing($dbc, $listing_date, $item_name, $price, $image, $description);
				$errors = array();
			}

		} elseif (Input::notEmpty('deleted_item_name')) {
			$deleteListing($dbc);
		} else {
			echo "Please make a valid entry.";
		}
	}
	
}






pageController($dbc);

?>
<!doctype html>
<html>
<head>
	<title>Listings Database</title>
</head>
<body>
	<h4>We are on page <?= $page ?></h4>

	<?php if ($page > 1) { ?>
		<a href="?page=<?= $page-1 ?>">Previous</a>
	<?php } ?>
	<?php if ($page < $pageLimiter) { ?>
		<a href="?page=<?= $page+1 ?>">Next</a>
	<?php } ?>

	<table>
		<tr>
			<th>Listing Date</th>
			<th>Item Name</th>
			<th>$</th>
			<th>Image</th>
			<th>Description</th>
		</tr>
		<?php foreach($listings as $listing): ?>
			<tr>	
				<th><?= $listing['item_name'] ?>
					<form method="POST">
						<button name="deleted_item_name" type="submit" value="<?=$listing['item_name']?>"></button>
					</form>
				</th>
				<th><?= $listing['item_name'] ?></th>
				<th><?= $listing['price'] ?></th>
				<th><?= $listing['image'] ?></th>
				<th><?= $listing['description'] ?></th>
			</tr>
		<?php endforeach ?>
	</table>
	<div>
			<form method="POST">
        		<input type="text" id="listing_date" name="listing_date" placeholder="Listing Date">
        		<input type="text" id="item_name" name="item_name" placeholder="Item Name">
        		<input type="text" id="price" name="price" placeholder="Price">
          		<input type="text" id="image" name="image" placeholder="Image">
          		<input type="textarea" id="description" name="description" placeholder="Description">
        		<input type="submit" value="add">	
   			</form>
		</div>
</body>
</html>