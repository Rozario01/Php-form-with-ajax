<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_dB";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve all user records from the database
$sql = "SELECT * FROM details LIMIT 0 , 25";
$result = mysqli_query($conn, $sql);

// Create an array to store the user records
$users = array();

// Loop through each record and add it to the array
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Convert the array to JSON and return it
echo json_encode($users);

mysqli_close($conn);
