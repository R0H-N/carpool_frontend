
<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if the user is not logged in
    echo json_encode(array("success" => false, "message" => "User is not logged in."));
    exit();
}

// Check if the ride_id is provided
if (!isset($_POST['rideId'])) {
    // Handle the case where rideId is not provided
    echo json_encode(array("success" => false, "message" => "Ride ID is not provided."));
    exit();
}

$ride_id = $_POST['rideId'];
$booker_email = $_SESSION['email']; // Get the email of the logged-in user

// Database connection parameters
$servername = "localhost";
$username = "root";
$db_password = ""; // Replace with your actual database password
$database = "carpool_db";

// Create a connection to the database
$conn = new mysqli($servername, $username, $db_password, $database);

// Check the connection
if ($conn->connect_error) {
    // Handle database connection error
    echo json_encode(array("success" => false, "message" => "Database connection failed: " . $conn->connect_error));
    exit();
}

// Retrieve ride details
$ride_sql = "SELECT * FROM rides WHERE id = '$ride_id' AND booking_status = 0";
$ride_result = $conn->query($ride_sql);

if ($ride_result->num_rows > 0) {
    // Ride found, update booking status
    $update_sql = "UPDATE rides SET booking_status = 1, booked_by = '$booker_email' WHERE id = '$ride_id'";

    if ($conn->query($update_sql) === TRUE) {
        // Ride booked successfully

        // Retrieve details of the ride
        $ride_details = $ride_result->fetch_assoc();
        $host_email = $ride_details['user_email'];

        // Close the database connection
        $conn->close();

        // Send confirmation emails
        sendConfirmationEmail($booker_email, $host_email, $ride_details);

        // Return success response
        echo json_encode(array("success" => true, "message" => "Ride booked successfully."));
        exit();
        header("Location: thank_you.php");

    } else {
        // Error updating database
        echo json_encode(array("success" => false, "message" => "Error updating database: " . $conn->error));
        exit();
    }
} else {
    // Ride not found or already booked
    echo json_encode(array("success" => false, "message" => "Ride not available for booking."));
    exit();
}

// Function to send confirmation emails
function sendConfirmationEmail($booker_email, $host_email, $ride_details) {
    // Include PHPMailer autoload file generated by Composer
    require 'phpMailer/vendor/autoload.php';

    // Create a new PHPMailer instance
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rohn.py@gmail.com'; // Your Gmail email address
    $mail->Password = 'asdm jgbl ihcx hhvu'; // Your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender and recipient settings
    $mail->setFrom('rohn.py@gmail.com', 'Carpooling'); // Your Gmail email address and your name
    $mail->addAddress($booker_email); // Booker's email address
    $mail->addAddress($host_email); // Host's email address

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Ride Booking Confirmation';
    $mail->Body = "Dear {$booker_email},<br><br>
We are pleased to inform you that your booking for the ride from {$ride_details['departure_location']} to {$ride_details['destination']} on {$ride_details['departure_date']} at {$ride_details['departure_time']} has been confirmed successfully.<br><br>
Details of your ride:<br>
- Date: {$ride_details['departure_date']}<br>
- Time: {$ride_details['departure_time']}<br>
- Pick-up Location: {$ride_details['departure_location']}<br>
- Destination: {$ride_details['destination']}<br><br>
Thank you for choosing our carpooling service. We look forward to providing you with a comfortable and convenient ride.<br><br>
Should you have any inquiries or require further assistance, please do not hesitate to contact us.<br><br>
Best regards,<br>
The Carpooling Team";

    // Send email
    if (!$mail->send()) {
        // Log error if sending fails
        echo 'Failed to send confirmation email: ' . $mail->ErrorInfo;
    }
}
?>
