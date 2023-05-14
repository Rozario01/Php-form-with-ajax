<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_dB";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed :" . mysqli_connect_error());
}
// Delete all users from database 
$sql = "DELETE FROM `details`";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->query($sql) === TRUE) {
        echo "All Records deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
