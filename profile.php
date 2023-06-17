<?php
include 'database_connection.php';
include 'index.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input
    $meetingDate = $_POST['meeting_date'];
    $meetingTime = $_POST['meeting_time'];
    $participant1 = $_POST['participant1'];
    $participant2 = $_POST['participant2'];

    // Validate user input (you can add more validation if needed)
    if (empty($meetingDate) || empty($meetingTime) || empty($participant1) || empty($participant2)) {
        $error = 'Please fill in all fields.';
    } else {
        // Check if participants are available at the specified time
        $stmt = $connection->prepare("SELECT COUNT(*) FROM meetings WHERE meeting_date = ? AND meeting_time = ? AND (participant1 = ? OR participant2 = ?)");
        $stmt->bind_param("ssss", $meetingDate, $meetingTime, $participant1, $participant2);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $error = 'Participants are not available at the specified time.';
        } else {
            // Prepare the SQL statement
            $sql = "INSERT INTO meetings (meeting_date, meeting_time, participant1, participant2) VALUES (?, ?, ?, ?)";

            // Create a prepared statement
            $stmt = $connection->prepare($sql);

            // Bind the parameters
            $stmt->bind_param("ssss", $meetingDate, $meetingTime, $participant1, $participant2);

            // Execute the statement
            if ($stmt->execute()) {
                // Example: Display a success message
                $successMessage = 'Meeting successfully booked!';
            } else {
                // Example: Display an error message
                $error = 'Error in booking the meeting.';
            }

            // Close the statement
            $stmt->close();
        }
    }
}

// Check if the user is logged in and retrieve the email of the logged-in user
$loggedInEmail = '';
if (isset($_SESSION['email'])) {
    $loggedInEmail = $_SESSION['email'];
}

// Retrieve registered profiles from the database excluding the logged-in user
$sql = "SELECT * FROM users WHERE email != ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $loggedInEmail);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

// Check if any profiles are found
if ($result->num_rows > 0) {
    // Output data of each profile
    while ($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "<a href=\"book_meeting.php?profile_id=" . $row["id"] . "&participant2_email=" . $row["email"] . "\">Book Meeting</a><br>";
        echo "<br><br>";
    }
} else {
    echo "No profiles found.";
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search | Schedl</title>
    
<style>
    body {
        margin: 0;
        padding: 0;
    }

</style>

</head>

<body>

</body>
</html>
