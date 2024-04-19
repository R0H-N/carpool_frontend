<?php
    session_start();
    $isLoggedIn = isset($_SESSION['email']);
    echo json_encode($isLoggedIn);
?>
