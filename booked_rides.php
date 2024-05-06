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

// Retrieve all rides booked by the logged-in user
$sql = "SELECT rides.*, users.name AS host_name, users.email AS host_email, users.profile_pic AS host_profile_pic FROM rides JOIN users ON rides.user_email = users.email WHERE booked_by = '$user_email'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booked Rides</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="rideshare.css" /> <!-- Assuming you have a rideshare.css file for styling -->
    <style>
        .ride-block {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .ride-info {
            flex: 1;
        }

        .host-profile img {
            width: 100px; /* Adjust the size as needed */
            height: auto;
            margin-left: 20px;
        }
    </style>
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
        <h2>My Booked Rides</h2>
        <?php
        if ($result && $result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="ride-block">
                    <div class="ride-info">
                        <p><strong>Departure Location:</strong> <?php echo $row['departure_location']; ?></p>
                        <p><strong>Destination:</strong> <?php echo $row['destination']; ?></p>
                        <p><strong>Seats Available:</strong> <?php echo $row['seats_available']; ?></p>
                        <p><strong>Luggage Available:</strong> <?php echo $row['luggage_available']; ?></p>
                        <p><strong>Date:</strong> <?php echo $row['departure_date']; ?></p>
                        <p><strong>Time:</strong> <?php echo $row['departure_time']; ?></p>
                        <p><strong>Host Name:</strong> <?php echo $row['host_name']; ?></p>
                        <p><strong>Host Email:</strong> <?php echo $row['host_email']; ?></p>
                    </div>
                    <div class="host-profile">
                        <?php if (!empty($row['host_profile_pic'])): ?>
                            <img src="<?php echo $row['host_profile_pic']; ?>" alt="Host Profile Pic">
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No rides booked yet.</p>";
        }
        ?>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
