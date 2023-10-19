<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receive data from the signup form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Perform basic input validation (you can add more validation)
    if (empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $db_password = "";
        $database = "carpool_db";
        
        // Create a connection to the database
        $conn = new mysqli($servername, $username, $db_password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Securely hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database
        $insert_sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
        
        if ($conn->query($insert_sql) === TRUE) {
            // Registration successful
            header("Location: signup.html"); // Redirect to signup.html after successful registration
            exit();
        } else {
            $error_message = "Error: " . $insert_sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
}
?>
