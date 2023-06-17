<?php
include 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform validation if needed

    // Insert user information into the database
    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($connection->query($query) === TRUE) {
        // Redirect the user to a success page or perform any other actions
        header("Location: login.php");
        exit();
    } else {
        // Handle the case when the query execution fails
        echo "Error: " . $connection->error;
    }
}
?>
