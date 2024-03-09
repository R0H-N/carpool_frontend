<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which button was clicked
    if (isset($_POST['host_ride'])) {
        // Redirect to the page for hosting a ride
        header("Location: host_ride.php");
        exit();
    } elseif (isset($_POST['join_ride'])) {
        // Redirect to the page for joining a ride
        header("Location: join_ride.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Management</title>
</head>
<body>
    <h2>Welcome to the Carpooling Website!</h2>
    <p>Please select an option:</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="host_ride">Host a Ride</button>
        <button type="submit" name="join_ride">Join a Ride</button>
    </form>
</body>
</html>
