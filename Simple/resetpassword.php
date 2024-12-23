<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have at least 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE user SET password = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully. Destroy the session and redirect to the login page
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div id="logo">
    <!-- Logoand Heading-->
    <img src="IMG/Logo.PNG" alt="main_logo..." class="logo" />
</div>

<body>
    <div class="wrapper">
        <h2>Reset Password</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- New Password input -->
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>

            <!-- Confirm Password input -->
            <div class="form-group">
                <label>Confirm Your New Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>

            <!-- Submit and Cancel buttons -->
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="dashboard.php"> Cancel</a>
            </div>

        </form>
    </div>
</body>

<style>
         body{ font: 16px times; text-align: center; background: #B9E6FF; margin: 0; padding: 0; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .wrapper{ width: 360px; padding: 20px; }
        .logo { width: 200px; position: absolute; top: 10px; left: 10px; border-radius: 20px;}
    </style>
    
</html>
