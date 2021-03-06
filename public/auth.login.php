<?php

require_once '../bootstrap.php';

if(!empty($_POST))
{
  $username = Input::get('username');
  $password = Input::get('pwd');

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $message = '';

  Auth::attempt($username, $password);

  if (Auth::check()) 
  {
    $username = Auth::user();
    header("Location: users.show.php");
    die();
  }
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
  <?php require_once('../views/partials/navbar.php') ?>
    <div class="col-md-6">
      <h2>Sign in</h2>

      <form role="form" method="post" action="auth.login.php">

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

  </div>

</body>
</html>


