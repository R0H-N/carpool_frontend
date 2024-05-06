<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Available Rides</title>
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
            </div>
        </nav>
    </section>

    <div class="container">
        <h2>All Available Rides</h2>
        <!-- Search form -->
        <form method="post">
            <div class="mb-3">
                <label for="departure" class="form-label">Departure Location:</label>
                <input type="text" class="form-control" id="departure" name="departure" placeholder="Enter departure location">
            </div>
            <div class="mb-3">
                <label for="destination" class="form-label">Destination:</label>
                <input type="text" class="form-control" id="destination" name="destination" placeholder="Enter destination">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <!-- End of search form -->

        <!-- PHP code to display rides -->
        <?php
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

        // Retrieve search parameters if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $departure = $_POST['departure'];
            $destination = $_POST['destination'];
            $sql = "SELECT * FROM rides WHERE departure_location LIKE '%$departure%' AND destination LIKE '%$destination%' AND booking_status = 0";
        } else {
            // If form is not submitted, retrieve all rides
            $sql = "SELECT * FROM rides WHERE booking_status = 0";
        }

        $result = $conn->query($sql);

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
            echo "<p>No rides available.</p>";
        }
        ?>
        <!-- End of PHP code to display rides -->
    </div>

    <script>
    function bookRide(rideId) {
        // Display a confirmation message
        var confirmed = window.confirm("Are you sure you want to book this ride?");
        
        // If user confirms, proceed with booking
        if (confirmed) {
            // AJAX request to process_booking.php
            fetch("process_booking.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "rideId=" + rideId
            })
            .then(response => response.json()) // Parse response as JSON
            .then(data => {
                // Check if the response is successful
                if (data.success) {
                    // Booking successful, display success message to user
                    alert(data.message);

                    window.location.href = "thank_host.html";
                    // Optionally, you can reload the page or update the UI as needed
                    window.location.reload(); // Reload the page to reflect changes
                } else {
                    // Booking failed, display error message to user
                    alert(data.message);
                }
            })
            .catch(error => {
                // Handle errors
                console.error("There was a problem with the fetch operation:", error);
                alert("An error occurred. Please try again later.");
            });
        }
    }
    </script>
</body>
</html>
