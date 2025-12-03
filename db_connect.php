<?php
// XAMPP-compatible database connection
$servername = "localhost";
$username = "root"; 
$password = ""; // Default XAMPP MySQL password
$dbname = "student_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // For XAMPP development, show error
    die("Connection failed: " . $conn->connect_error);
    
    // For production, hide error:
    // error_log("Database connection error: " . $conn->connect_error);
    // die("Database connection failed. Please try again later.");
}
?>