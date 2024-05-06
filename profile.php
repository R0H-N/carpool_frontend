<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Get the logged-in user's email
$user_email = $_SESSION['email'];

// Database connection parameters
$servername = "localhost";
$username = "root";
$db_password = ""; // Replace with your actual database password
$database = "carpool_db";

// Create a connection to the database
$conn = new mysqli($servername, $username, $db_password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user profile information
$sql = "SELECT * FROM users WHERE email = '$user_email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $bio = $row['bio'];
    $profile_pic = $row['profile_pic']; // Added profile picture field
} else {
    // User not found
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="rideshare.css" /> <!-- Assuming you have a rideshare.css file for styling -->
</head>
<body>
    <section class="home">
        <!-- Your navbar code goes here -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Carpooling</a>
            </div>
        </nav>
    </section>

    <div class="container">
        <h2>Profile</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="profile_pic" class="form-label">Profile Picture</label>
                    <div>
                        <?php if ($profile_pic) : ?>
                            <img src="<?php echo $profile_pic; ?>" alt="Profile Picture" style="max-width: 200px;">
                        <?php else: ?>
                            <p>No profile picture available</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea class="form-control" id="bio" name="bio" readonly><?php echo $bio; ?></textarea>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
