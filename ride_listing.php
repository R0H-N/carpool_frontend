<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit();
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$db_password = ""; // Please replace with your actual database password
$database = "carpool_db";

// Create a connection to the database
$conn = new mysqli($servername, $username, $db_password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve rides hosted by the logged-in user
$email = $_SESSION['email']; // Get the email of the logged-in user

// Retrieve search parameters if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departure = $_POST['departure'];
    $destination = $_POST['destination'];
    $sql = "SELECT * FROM rides WHERE user_email = '$email' AND departure_location LIKE '%$departure%' AND destination LIKE '%$destination%' AND booking_status = 0";
} else {
    // If form is not submitted, retrieve all rides hosted by the user
    $sql = "SELECT * FROM rides WHERE user_email = '$email' AND booking_status = 0";
}

$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Hosted Rides</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="rideshare.css" /> <!-- Assuming you have a rideshare.css file for styling -->
    <style>
        .ride-block {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .book-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <section class="home">
        <!-- Your navbar code goes here -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Carpooling</a>
                <form class="d-flex" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input class="form-control me-2" type="search" placeholder="Departure" aria-label="Search" name="departure">
                    <input class="form-control me-2" type="search" placeholder="Destination" aria-label="Search" name="destination">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </section>

    <div class="container">
        <h2>My Hosted Rides</h2>
        <?php
        if ($result && $result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="ride-block">
                    <p><strong>Departure Location:</strong> <?php echo $row['departure_location']; ?></p>
                    <p><strong>Destination:</strong> <?php echo $row['destination']; ?></p>
                    <p><strong>Seats Available:</strong> <?php echo $row['seats_available']; ?></p>
                    <p><strong>Luggage Available:</strong> <?php echo $row['luggage_available']; ?></p>
                    <button class="book-btn" onclick="bookRide(<?php echo $row['id']; ?>)">Book</button>
                    <!-- Add more details as needed -->
                </div>
                <?php
            }
        } else {
            echo "<p>No rides hosted yet.</p>";
        }
        ?>
    </div>

    <script>
        function bookRide(rideId) {
            // You can implement the booking logic here, like making an AJAX request to the server
            alert("Booking ride with ID: " + rideId);
        }
    </script>
</body>
</html>
