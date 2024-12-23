<?php
// Include config file
require_once "config.php";

// Defining variables and initialize with empty values
$name = $fats = $carbs = $protein = "";
$name_err = $fats_err = $carbs_err = $protein_err = "";

// Processing form data when the form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get the hidden input value
    $id = $_POST["id"];

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate fats
    $input_fats = trim($_POST["fats"]);
    if (!is_numeric($input_fats) || $input_fats < 0) {
        $fats_err = "Please enter a non-negative numeric value.";
    } else {
        $fats = $input_fats;
    }

    // Validate carbs
    $input_carbs = trim($_POST["carbs"]);
    if (!is_numeric($input_carbs) || $input_carbs < 0) {
        $carbs_err = "Please enter a non-negative numeric value.";
    } else {
        $carbs = $input_carbs;
    }

    // Validate protein
    $input_protein = trim($_POST["protein"]);
    if (!is_numeric($input_protein) || $input_protein < 0) {
        $protein_err = "Please enter a non-negative numeric value.";
    } else {
        $protein = $input_protein;
    }

    // Check input errors before inserting into the database
    if (empty($name_err) && empty($fats_err) && empty($carbs_err) && empty($protein_err)) {
        // Prepare an update statement
        $sql = "UPDATE foodlist SET name=?, fats=?, carbs=?, protein=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_fats, $param_carbs, $param_protein, $param_id);

            // Set parameters
            $param_name = $name;
            $param_fats = $fats;
            $param_carbs = $carbs;
            $param_protein = $protein;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to the landing page
                header("location: foodlist.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }

    // Close the connection
    mysqli_close($link);
} else {
    // Check the existence of the id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get the URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM foodlist WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    // Fetch the result row as an associative array. Since the result set contains only one row, we don't need to use a while loop
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field values
                    $name = $row["name"];
                    $fats = $row["fats"];
                    $carbs = $row["carbs"];
                    $protein = $row["protein"];
                }
            }
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        // Close the connection
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div id="logo">
        <!-- HealthHarbor logo -->
        <img src="IMG/Logo.PNG" alt="main_logo..." class="logo" />
    </div>

<body>
    <div class="wrapper">
                    <h2 class="mt-5">Edit Record</h2>

                    <!-- Form for editing an existing record -->
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        <!-- For fats -->
                        <div class="form-group">
                            <label>Fats</label>
                            <input name="fats" class="form-control <?php echo (!empty($fats_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fats; ?>">
                            <span class="invalid-feedback"><?php echo $fats_err; ?></span>
                        </div>
                        <!-- For carbs -->
                        <div class="form-group">
                            <label>Carbs</label>
                            <input type="text" name="carbs" class="form-control <?php echo (!empty($carbs_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $carbs; ?>">
                            <span class="invalid-feedback"><?php echo $carbs_err; ?></span>
                        </div>
                        <!-- For protein -->
                        <div class="form-group">
                            <label>Protein</label>
                            <input type="text" name="protein" class="form-control <?php echo (!empty($protein_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $protein; ?>">
                            <span class="invalid-feedback"><?php echo $protein_err; ?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn" value="Submit">
                        <a href="foodlist.php" class="btn">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
        .wrapper{ max-width: 400px; margin: 50px auto; padding: 20px; }
        body { background-color: #CEB992; }
        .logo { width: 140px; position: absolute; top: 55px; left: 10px; border-radius: 20px;}
        .btn {background-color: #5B2E48; color:#fff;}
    </style>

