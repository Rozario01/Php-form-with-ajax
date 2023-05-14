<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_dB";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];

    // Insert data into database
    $sql = "INSERT INTO details (username, email, phone_number) VALUES ('$username', '$email', '$phone_number')";
    if ($conn->query($sql) === TRUE) {
        echo "Record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
