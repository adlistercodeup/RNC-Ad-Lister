<?php
require_once "../utils/Auth.php";
require_once "../utils/Input.php";

session_start();

// $sessionId = session_id();

$username = Input::get('username');
$pass = Input::get('pwd');

$password=password_hash('$pass');


$message = '';

Auth::attempt($username, $password);

if (Auth::check()) {
	header("Location: users.show.php");
	die();
}

Auth::user();

?>


<!doctype html>
<html lang='en'>
<head>

    <?php require_once('../views/partials/head.php'); ?>
    <title>Login form for Adlister</title>
    
</head>


<body>

  <div class="container">

  <?php require_once('../views/partials/header.php') ?> 
  <?php require_once('../views/partials/navbar.php') ?>

    <h2>Sign in</h2>
    <form role="form" method="post" action="users.show.php">

      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" placeholder="Username" name="username" required autofocus value="<?= $username ?>">
      </div>

      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" required placeholder="Enter password" name="pwd">
      </div>

      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>

      <!-- <button type="submit" class="btn btn-default">Submit</button> -->


            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" value="Logout">
                </div>
            </div>

    </form>

  <?php require_once('../views/partials/footer.php') ?>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>


