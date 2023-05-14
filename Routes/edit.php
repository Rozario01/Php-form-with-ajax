<?php
// Include database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_dB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["id"]) $id = $_POST["id"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $sql = "UPDATE details SET username='$username', email='$email', phone_number='$phone_number' WHERE id=$id";
    if ($conn->query($sql)) {
        echo "Record Updated succesfully";
    } else {
        echo "Error:" . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
