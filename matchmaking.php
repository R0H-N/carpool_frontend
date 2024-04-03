    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Matchmaking</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
        <link rel="stylesheet" href="stylemain.css" />
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <section class="home">
            <!-- Your navbar code goes here -->
        </section>

        <div class="search-bar">
            <!-- Your search bar code goes here -->
        </div>

        <div class="container">
            <div class="available-carpools">
                <h1>Available Carpools</h1>
            </div>

            <?php
            // Start session
            session_start();

            // Check if pickup location is set in session
            if (!isset($_SESSION['pickup_location'])) {
                header("Location: home.html"); // Redirect to login page if pickup location is not set
                exit;
            }

            // Retrieve pickup location from session
            $pickupLocation = $_SESSION['pickup_location'];

            // Assuming you have a database connection established
            // Perform a query to fetch available rides where departure location matches user's pickup location
            // Modify this query according to your database schema and criteria
            $sql = "SELECT * FROM rides WHERE departure_location = '$pickupLocation'";
            $result = mysqli_query($conn, $sql);

            // Display available rides
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='ride'>";
                echo "<p>Departure Location: " . $row['departure_location'] . "</p>";
                echo "<p>Destination: " . $row['destination'] . "</p>";
                // Add more ride details as needed
                echo "<button class='choose-ride' data-ride-id='" . $row['id'] . "'>Choose Ride</button>";
                echo "</div>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
    </body>
    </html>
