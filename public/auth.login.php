<?php
require_once "../utils/Auth.php";
require_once "../utils/Input.php";
require_once "../utils/Logger.php";

session_start();

if (!empty($_POST)){
  

  // $sessionId = session_id();

  $username = Input::get('username');
  $password = Input::get('pwd');

  


  $message = '';

  Auth::attempt($username, $password);

  if (Auth::check()) {
  	header("Location: users.show.php");
  	die();
  }

  Auth::user();
}


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


  <div class="col-md-6">
    <h2>Sign in</h2>
    <form role="form" method="post" action="users.show.php">

      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" placeholder="Username" name="username" required autofocus placeholder = "Username">
      </div>

      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" required placeholder="Enter password" name="pwd">
      </div>

      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>

      <!-- <button type="submit" class="btn btn-default">Submit</button> -->


        <input id="submit" class="submit-button" type="submit" value = "Submit">

    </form>
  </div>

  <?php require_once('../views/partials/footer.php') ?>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>


