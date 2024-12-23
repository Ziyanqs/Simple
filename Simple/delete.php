<?php
// Process delete operation after confirmation
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Include config file
    require_once "config.php";

    // Prepare a delete statement
    $sql = "DELETE FROM foodlist WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_POST["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records deleted successfully. Redirect to landing page
            header("location: foodlist.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div id="logo">
        <!-- Logo -->
        <img src="IMG/Logo.PNG" alt="main_logo..." class="logo" />
    </div>

<body>
    <div class="wrapper">
                    <h2 class="mt-5 mb-3">Delete This Record</h2>
                    <!-- Confirming the delete operation -->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Are you sure you want to delete this food item from the list?</p>
                            <p class="button">
                                <input type="submit" value="Yes" class="btn">
                                <a href="foodlist.php" class="btn">Return To FoodList</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
        body { background-color: #CEB992; }
        .wrapper{ max-width: 700px; margin: 50px auto; padding: 20px; }
        .logo { width: 140px; position: absolute; top: 55px; left: 10px; border-radius: 20px;}
        .btn {background-color: #5B2E48; color:#fff;}
    </style>

</html>