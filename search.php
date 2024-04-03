<?php
// Assuming you have a database connection established

// Start session to access session data
session_start();

// Check if the search term is provided
if(isset($_POST['search'])) {
    // Sanitize the search term to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $_POST['search']);

    // Query to search for carpools based on the provided search term
    $sql = "SELECT * FROM rides WHERE departure_location LIKE '%$searchTerm%' OR destination LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $sql);

    // Check if there are any matching results
    if(mysqli_num_rows($result) > 0) {
        // Display the matching results
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='ride'>";
            echo "<p>Departure Location: " . $row['departure_location'] . "</p>";
            echo "<p>Destination: " . $row['destination'] . "</p>";
            // Add more fields as needed
            echo "<hr>";
            echo "</div>";
        }
    } else {
        // If no matching results found
        echo "<p>No carpools found matching your search term.</p>";
    }   
} else {
    // If the search term is not provided
    echo "<p>Please enter a search term.</p>";
}

// Display session data
if(isset($_SESSION['email'])) {
    echo "<p>Welcome, " . $_SESSION['email'] . "!</p>";
    echo "<p>Here are the search results:</p>";
} else {
    echo "<p>Please login to view search results.</p>";
}
?>
