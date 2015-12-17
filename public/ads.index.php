<?php
require_once '../database/adlist_db_config.php';
require_once '../database/adlist_db_connect.php';
require_once '../utils/Input.php';


function selectListing($dbc) {
	
	$activeListing = "SELECT * FROM ads WHERE status = 'active' LIMIT 25";

	$stmt = $dbc->query($activeListing);

	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

$results = selectListing($dbc);

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
			<h2>Active listing!!!</h2>
		</div>

		<?php foreach ($results as $key => $result) { ?>
			<div>

				<h3><a href=""> <span> <?= $result['listing_date']; ?> </span> <span> <?= $result['item_name']; ?> </span <span>$ <?=$result['price']; ?></span></a> </h3><hr>

			</div>

			<?php } ?>

		
	</div>
</body>
</html>