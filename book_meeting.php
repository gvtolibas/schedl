<?php

include 'database_connection.php';

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
            // Check if Participant 2 is a registered user
            $stmt = $connection->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->bind_param("s", $participant2);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            if ($count == 0) {
                $error = 'Participant 2 is not a registered user.';
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
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Booking | Schedl</title>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            top: 0;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
        }

        body {
            background-color: #fb6f92;
        }

        h1 {
            text-align: center;
            margin-top: 60px;
            color: #fff;
        }

        .navbar {
            background: white;
            padding: 10px 50px;
            top: 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
        }
        .navdiv {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo a {
            font-size: 25px;
            font-weight: 700;
            color: #fb6f92;
            pointer-events: none;
        }

        li {
            list-style: none;
            display: inline-block;
        }
        li a {
            color: #fb6f92;
            font-size: 20px;
            font-weight: bold;
            margin-right: 25px;
            border-radius: 20px;
            padding: 5px 15px;
            transition: .5s ease;
        }

        li a:hover, 
        li a.active {
            color: #fff;
            background-color: #fb6f92;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: 600;
        }

        .success {
            color: #48ff00;
            text-align: center;
            font-weight: 600;
        }

        label {
            font-size: 18px;
            margin-top: 5px;
            text-align: center;
            font-weight: 600; 
            color: #fff;
            background: transparent;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="email"] {
            width: 300px;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            display: block;
            color: #fb6f92;
            font-weight: 600; 
            font-size: 18px;
            border: none;
            background-color: #fff;
            border-radius: 10px;
        }

        input[type="submit"] {
            font-size: 18px;
            font-weight: 600;
            padding: 10px 20px;
            background: #fff;
            color: #4d0085;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;

            box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
            transition: .5s ease;
        }

        input[type="submit"]:hover {
            background-color: #fec8d8;
        }

        form {
            margin-top: 50px;
            text-align: center;
        }

        button{
		    color: #fff;
            font-weight: bold;
            font-size: 18px;
		    background-color: #fec8d8;
            margin-left: 10px;
            border: 5px;
            border-radius: 10px;
            padding: 5px 10px;
            cursor: pointer;
            transition: .5s ease;
	        }

        button:hover {
            background-color: #fb6f92;
        }
    </style>
</head>
<body>

<nav class="navbar">
        <div class="navdiv">
            <div class="logo"><a href="#">Schedl</a></div>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="book_meeting.php" class="active">Booking</a></li>
                <li><a href="profile.php">Search</a></li>

                <li><button onclick="logout()">Log out</button></li>
            </ul>
        </div>
    </nav>

    <h1>Book a Meeting Here</h1>

    <?php if (isset($error)) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if (isset($successMessage)) : ?>
        <p class="success"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="meeting_date">Date:</label>
        <input type="date" id="meeting_date" name="meeting_date" required><br>

        <label for="meeting_time">Time:</label>
        <input type="time" id="meeting_time" name="meeting_time" required><br>

        <label for="participant1">Participant 1:</label>
        <input type="email" id="participant1" name="participant1" placeholder="Email Address" required><br>

        <label for="participant2">Participant 2:</label>
        <input type="email" id="participant2" name="participant2" placeholder="Email Address" value="<?php echo $_GET['participant2_email'] ?? ''; ?>" required><br>
        
        <input type="submit" value="Book Meeting">
    </form>

    <script>
        function logout() {
            // Perform the logout process here
            // For example, you can clear session variables or perform other necessary tasks

            // Redirect the user to the login page after logout
            window.location.href = "login.php";
        }
    </script>
</body>
</html>
