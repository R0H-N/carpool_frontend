<?php

session_start();
echo "Reached here 1"; 

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receive data from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection parameters
    echo "Reached here 1"; 
    $servername = "localhost";  // Replace with your database server address
    $username = "root";  // Replace with your database username
    $db_password = "";  // Replace with your database password
    $database = "carpool_db";  // Replace with your database name

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $db_password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to check if the user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    echo "Reached here 2"; 

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        echo "Reached here 3"; 
        $stored_password = $row['password'];
        echo "Reached here 4 $stored_password"; 
        echo "$password";
        // Verify the entered password against the stored hashed password
        if (password_verify($password, $stored_password)) {
            // Authentication successful
           
  

            $_SESSION['email'] = $email; // Store user's email in a session variable
            // Redirect the user to the dashboard or home page
            header("Location: home.html"); // Change the URL to your dashboard page
            exit();
        } else {
            // Authentication failed (incorrect password)
            $error_message = "Incorrect email or password.";
            echo "$error_message";
            
            }

    } else {
        // Authentication failed (user not found)
        $error_message = "User not found.";
    }

    // Close the database connection
    $conn->close();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

// If not submitted or authentication failed, display the login form
?>
