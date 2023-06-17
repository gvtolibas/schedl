<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Home | Schedl</title>
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
        
        height: 100vh;
        width: 100%;
       
        box-sizing: border-box;
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

    .row {
        padding-left: 8%;
        padding-right: 8%;
        display: flex;
        height: 88%;
        align-items: center;
    }

    .col {
        flex-basis: 50%;
    }

    .col h1 {
        color: #fff;
        font-size: 50px;
    }

    .col p {
        color: #fff;
        font-size: 20px;
        line-height: 25px;
        margin-right: 40px;
    }

    .col button {
        width: 180px;
        color: #222;
        font-size: 18px;
        padding: 12px 0;
        background: #fff;
        border: 0;
        border-radius: 40px;
        outline: none;
        margin-top: 30px;

        box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
    }

    .col button:hover {
        background-color: #fec8d8;
    }

    .card {
        width: 700px;
        height: 250px;
        display: inline-block;
        border-radius: 10px;
        padding: 15px 25px;
        box-sizing: border-box;
        pointer-events: none;
        margin: 25px 15px;
       
        background-position: center;
        background-size: cover;
    }

    .card1 {
        background-image: url(gif/chat.gif);
    }

    .card2 {
        background-image: url(gif/chat2.gif);
    }

</style>
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo"><a href="#">Schedl</a></div>
            <ul>
                <li><a href="homepage.php" class="active">Home</a></li>
                <li><a href="book_meeting.php">Booking</a></li>
                <li><a href="profile.php">Search</a></li>

                <li><button onclick="logout()">Log out</button></li>
            </ul>
        </div>
    </nav>

    <div class="row">
        <div class="col">
            <h1>Welcome to Schedl,</h1>
            <p>the ultimate destination for hassle-free meeting scheduling. Our innovative platform empowers you to effortlessly book meetings with anyone, anywhere. Whether you're a busy professional, a freelancer, or simply looking to connect with others; Schedl streamlines the process, saving you valuable time and energy. With our intuitive interface and smart scheduling algorithms, finding common availability and coordinating appointments has never been easier. <br><br>Say goodbye to the back-and-forth emails and enjoy the convenience of a centralized scheduling hub. Join Schedl today and unlock a world of seamless meeting coordination at your fingertips. Your guide to a successful appointment.</p>
            <button type="button"><a href="book_meeting.php">Book a Meeting</a></button>
        </div>

        <div class="col">
            <div class="card card1"></div>
            <div class="card card2"></div>
        </div>
    </div>

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
