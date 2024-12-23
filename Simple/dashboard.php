<?php
// Initialize the session
session_start();

// Set the default timezone to America/New_York
date_default_timezone_set('America/New_York');

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Get the current date and time
$currentDateTime = date("[Y/m/d] H:i");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Logo -->
    <img src="IMG/Logo.PNG" alt="main_logo..." class="logo" />

    <!-- Sidebar navigation links -->
    <div class="sidebar">
        <a href="#">Chart</a>
        <a href="todayslist.php">Today</a>
        <a href="foodlist.php">Food</a>
    </div>

    <!-- Welcome message -->
    <h1 style= "font-size:40px; margin: 50px; font-weight: bold; font-style: italic;" >
    HELLO <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> <br> Welcome To Your Fitness Journey</h1>

    <!-- Buttons for resetting password and signing out -->
    <p class="button">
        <a href="resetpassword.php">Reset Your Password</a>
        <a href="signout.php">Sign Out of Your Account</a>
    </p>

    <!-- Display current date and time -->
    <p style="position: absolute; top: 5px; right: 0px; margin: 20px;">
        <?php echo "Current Date and Time: " . $currentDateTime; ?>
    </p>

    <!-- Copyright footer -->
    <footer>
        &copy; All Rights Reserved, 2023
    </footer>

    <!-- Navigation icons with links -->
    <a href="foodlist.php">
        <img src="IMG/foodlist.PNG" alt="foodlist..." class="foodicon" />
    </a>
    <a href="todayslist.php">
        <img src="IMG/todayslist.PNG" alt="todayslist..." class="todayicon" />
    </a>
    <img src="IMG/chart.PNG" alt="chart..." class="charticon" />

    <!-- Webpage description -->
    <p style="margin-right: 400px; margin-left: 50px; margin-top: 120px; text-indent: 10px; font-size: 36px; font-style: italic;">
    HealthHarbor is a diet dashboard that provides you with a comprehensive view of your daily nutritions like protein, fiber, and carbs. Easily manage your food intake by adding items to your 
    <a href="todayslist.php" style="color: #800080; text-decoration: bold;">Today's List</a>. Explore a variety of foods in the <a href="foodlist.php" style="color: #800080; text-decoration: bold;">
    Food List</a>, and also add Food items to the list that you eat regularly. Here is a start to a healthy living. <br><br>START WITH TRACKING YOUR DIET.
</p>

</body>

<style>
        body{font: 23px times; text-align: center; background: #CEB992; }
        footer {position: absolute; bottom: 0; left: 0; width: 100%; padding: 2px; background-color: #333; color: #fff; }
        .logo { width: 270px; position: absolute; top: 10px; left: 10px; border-radius: 20px; }
        .button { margin-top: -35px; background-color: #43291F; }
        .sidebar { background: #43291F; width: 190px; padding: 20px; position: fixed; height: 55%; right: 10px; display: flex; flex-direction: column; top: 30%; border-radius: 15px; }
        .sidebar a {color: #FA7921; padding: 30px; margin-bottom: 40px; display: flex; align-items: center; text-align: center; font-family: Times; font-size: 35px; text-shadow: 1px 1px 1px #f5895b; }
        .button a { display: inline-block; padding: 10px 20px; margin: 10px; color: #000; background-color: #FA7921; border-radius: 10px; }
        .foodicon { width: 50px; margin-top: 10px; margin-bottom: 20px; position: absolute; top: 560px; right: 20px; }
        .todayicon { width: 50px; margin-top: 10px; margin-bottom: 20px; position: absolute; top: 419px; right: 20px; }
        .charticon { width: 50px; margin-top: 10px; margin-bottom: 20px; position: absolute; top: 275px; right: 20px; }
   </style>
</html>

