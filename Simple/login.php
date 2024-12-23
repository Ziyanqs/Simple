<?php
// If user is already logged in redirect them
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}

// Including config file
require_once "config.php";

// Define variables and set their initial values empty
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Checking if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Checking if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM user WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            //Assign variables as parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Take user to the dashboard
                            header("location: dashboard.php");
                            exit();
                        } else {
                            // Password is not valid
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // If username doesn't exist
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Something went wrong. Please try again later.";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div id="logo">
        <!-- Logo and login heading-->
        <img src="IMG/Logo.PNG" alt="main_logo..." class="logo" />
    </div>

    <div class="wrapper">
        <h2>Login</h2>

        <?php
        // Display login error message, if any
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
           
        <!-- Username input -->
            <div class="form-group">
                <label>Username Here</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>

            <!-- Password input -->
            <div class="form-group">
                <label>Password Here</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>

            <!-- Submit button -->
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>

            <!-- Sign up link if no account -->
            <p>Wanna Join HealthHarbor Family? <a href="signup.php">Sign up now</a></p>

        </form>
    </div>
</body>

<style>
        body {font: 16px times; text-align: center; background: #B9E6FF; margin: 0; padding: 0; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .logo { width: 200px; position: absolute; top: 10px; left: 10px; border-radius: 20px; }
    </style>
    
</html>

