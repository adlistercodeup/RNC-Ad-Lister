<?php
function endSession()
{
    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
}
endSession();

// header("Location: auth.login.php");
// die();
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('../views/partials/head.php'); ?>
    <title>Where treasures are found and shared.</title>
</head>

<body>
    <div class="container">

        <?php include '../views/partials/navbar.php'; ?>

        <h1>Logged out</h1>

        <div id="footer">
        <?php include '../views/partials/footer.php'; ?>
        </div>
        
    </div>

</body>

</html>
