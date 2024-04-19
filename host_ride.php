  <?php
  // Start session
  session_start();

  // Check if the user is logged in
  if (!isset($_SESSION['email'])) {
      // Redirect to the login page if the user is not logged in
      header("Location: login.html");
      exit();
  }

  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Retrieve form data
      $departure_location = $_POST['departure-location'];
      $destination = $_POST['destination'];
      $car_name = $_POST['car-name'];
      $seats_available = $_POST['seats-available'];
      $luggage_available = $_POST['luggage-available'];
      $departure_date = $_POST['departure-date'];
      $departure_time = $_POST['departure-time'];
      $additional_info = $_POST['additional-info'];

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

      // Insert ride details into the database
      $email = $_SESSION['email']; // Get the email of the logged-in user
      $insert_sql = "INSERT INTO rides (departure_location, destination, user_email, car_name, seats_available, luggage_available, departure_date, departure_time, additional_info) 
                    VALUES ('$departure_location', '$destination', '$email', '$car_name', $seats_available, '$luggage_available', '$departure_date', '$departure_time', '$additional_info')";

      if ($conn->query($insert_sql) === TRUE) {
          // Ride hosted successfully
          $success_message = "Ride hosted successfully.";
          // Redirect to the thank you page
          header("Location: thank_host.html");
          exit();
      } else {
          // Error inserting ride into the database
          $error_message = "Error hosting ride: " . $conn->error;
      }

      // Close the database connection
      $conn->close();
  }
  ?>


  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Document</title>
      <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
      />
      <link rel="stylesheet" href="rideshare.css" />
      
    </head>

    <body>
      <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"
      ></script>

      <section class="home">
        <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img
                src="green-car-removebg-preview.png"
                alt="Logo"
                width="40"
                height="30"
                class="d-inline-block align-text-top"
              /><b> Carpooling </b>
            </a>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="home.html">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="contactus.html">About us</a>
                </li>
              
                <li class="nav-item">
                  <a class="nav-link active" href="#">Contact</a>
                </li>
                <li class="nav-item dropdown">
                  <a
                    class="nav-link active dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Dropdown
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
              </ul>
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link" href="update_profile.html">
                          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                              <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM7 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm1 8.5a2.5 2.5 0 1 1-3 0 5 5 0 0 1 3 0zm4.338 1.5H5.662A4.5 4.5 0 0 0 1 14.5c0 1.5 3.134 2.5 7 2.5s7-1 7-2.5a4.5 4.5 0 0 0-4.662-4.5z"/>
                          </svg>
                      </a>
                  </li>
              </ul>
              
            </div>
          </div>
        </nav>


      

  <video autoplay loop muted plays-inline class="back-video">
      <source src="Untitled video - Made with Clipchamp.mp4" type="video/mp4">
  </video>


  <div class="container1">
    <h2>Ride Sharing</h2>
    <?php if(isset($_SESSION['email'])) { ?>
    <div class="options">
      <div class="option" id="host-option" style="background-color: black;">Host a Ride</div>
      <div class="option" id="get-option"style="background-color: black;">Get a Ride</div>
    </div>
    <div id="host-ride-form">
      <form method="POST" action="host_ride.php">
        <div class="form-group">
          <label for="departure-location">Departure Location:</label>
          <input type="text" id="departure-location" name="departure-location" required>
        </div>
        <div class="form-group">
          <label for="destination">Destination:</label>
          <input type="text" id="destination" name="destination" required>
        </div>
        <div class="form-group">
          <label for="car-name">Car Name:</label>
          <input type="text" id="car-name" name="car-name" required>
        </div>
        <div class="form-group">
          <label for="seats-available">Seats Available:</label>
          <input type="number" id="seats-available" name="seats-available" required>
        </div>
        <div class="form-group">
          <label for="luggage-available">Luggage Available:</label>
          <select id="luggage-available" name="luggage-available" required>
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
        </div>
        <div class="form-group">
          <label for="departure-date">Departure Date:</label>
          <input type="date" id="departure-date" name="departure-date" required>
        </div>
        <div class="form-group">
          <label for="departure-time">Departure Time:</label>
          <input type="time" id="departure-time" name="departure-time" required>
        </div>
        <div class="form-group">
          <label for="additional-info">Additional Information:</label>
          <textarea id="additional-info" name="additional-info" rows="4"></textarea>
        </div>
        <button type="submit" class="host-ride-button"style="background-color: black;">Host Ride</button>
      </form>
    </div>
    <div id="get-ride-form" style="display: none;">
      <form method="post" action="host_ride.php">
        <div class="form-group">
          <label for="pickup-location">Pickup Location:</label>
          <input type="text" id="pickup-location" name="pickup-location" required>
        </div>
        <div class="form-group">
          <label for="destination-get">Destination:</label>
          <input type="text" id="destination-get" name="destination-get" required>
        </div>
        <div class="form-group">
          <label for="seats-required">Seats Required:</label>
          <input type="number" id="seats-required" name="seats-required" required>
        </div>
        <div class="form-group">
          <label for="luggage-present">Luggage Present:</label>
          <select id="luggage-present" name="luggage-present" required>
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
        </div>
        <div class="form-group">
          <label for="pickup-date">Pickup Date:</label>
          <input type="date" id="pickup-date" name="pickup-date" required>
        </div>
        <div class="form-group">
          <label for="pickup-time">Pickup Time:</label>
          <input type="time" id="pickup-time" name="pickup-time" required>
        </div>
        <div class="form-group">
          <label for="additional-info">Additional Information:</label>
          <textarea id="additional-info" name="additional-info" rows="4"></textarea>
        </div>
        <button type="submit" class="get-ride-button"style="background-color: black;">Get Ride</button>
      </form>
    </div>
    <?php } else { ?>
    <!-- Show message to login -->
    <p>Please <a href="home.html">login</a> to host or search for a ride.</p>
    <?php } ?>
  </div>

  <script src="rideshare.js"></script>
      </section>
    


  </html>
