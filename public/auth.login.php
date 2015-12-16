<?php
require_once "../utils/Auth.php";
require_once "../utils/Input.php";

session_start();

// $sessionId = session_id();

$username = Input::get('username');
$password = Input::get('password');
$message = '';

Auth::attempt($username, $password);

if (Auth::check()) {
	header("Location: users.show.php");
	die();
}

Auth::user();

?>ø


<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Login form for Adlister</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>


<body>

<div class="container">
  <h2>Sign in</h2>
  <form role="form">

    <div class="form-group" method="POST" action = "users.show.php">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?= $username ?>">
    </div>

    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>

    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>

  </form>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html>


