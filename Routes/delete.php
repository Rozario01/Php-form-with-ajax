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

// Delete the user record
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM details WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "User record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
