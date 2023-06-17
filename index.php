<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   
   <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

</head>
<style type="text/css">
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
    * {
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
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

    .search-form {
        margin-right: 25px;
    }
    /* .search-input {
        width: 200px;
        padding: 5px;
        border-radius: 5px;
        border: none;
    } */
    /* .search-button {
        background: transparent;
        margin: 0;
        border: none;
        padding: 5px 10px;
    } */
    .search-button a {
        color: #fb6f92;
        font-weight: bold;
        font-size: 20px;
    }
    body {
        background-color: #fb6f92;
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
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo"><a href="#">Schedl</a></div>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="book_meeting.php">Booking</a></li>
                <li><a href="profile.php" class="active">Search</a></li>

                <li><button onclick="logout()">Log out</button></li>
            </ul>
        </div>
    </nav>

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
