<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receive data from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection parameters
    $servername = "localhost";  // Replace with your database server address
    $username = "root";  // Replace with your database username
    $password = "";  // Replace with your database password
    $database = "users";  // Replace with your database name

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to check if the user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
        // Verify the entered password against the stored hashed password
        if (password_verify($password, $stored_password)) {
            // Authentication successful
            session_start(); // Start a session (if not already started)
            $_SESSION['email'] = $email; // Store user's email in a session variable
            // Redirect the user to the dashboard or home page
            header("Location: dashboard.php"); // Change the URL to your dashboard page
            exit();
        } else {
            // Authentication failed (incorrect password)
            $error_message = "Incorrect email or password.";
        }
    } else {
        // Authentication failed (user not found)
        $error_message = "User not found.";
    }

    // Close the database connection
    $conn->close();
}

// If not submitted or authentication failed, display the login form
?>
