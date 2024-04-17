<?php
// Start session to store ride request data
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $pickupLocation = htmlspecialchars($_POST['pickup-location']);
    $destination = htmlspecialchars($_POST['destination-get']);
    $seatsRequired = intval($_POST['seats-required']); // Convert to integer
    $luggagePresent = htmlspecialchars($_POST['luggage-present']);
    $pickupDate = htmlspecialchars($_POST['pickup-date']);
    $pickupTime = htmlspecialchars($_POST['pickup-time']);
    $additionalInfo = htmlspecialchars($_POST['additional-info']);

    // Store the ride request data in session variables
    $_SESSION['ride_request'] = array(
        'pickup_location' => $pickupLocation,
        'destination' => $destination,
        'seats_required' => $seatsRequired,
        'luggage_present' => $luggagePresent,
        'pickup_date' => $pickupDate,
        'pickup_time' => $pickupTime,
        'additional_info' => $additionalInfo
    );

    // Redirect the user to the matchmaking page
    header("Location: matchmaking.php");
    exit;
} else {
    // If the form is not submitted, redirect the user back to the form page
    header("Location: main.html");
    exit;
}
?>
