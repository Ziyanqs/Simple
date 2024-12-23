<?php
// Include config file
require_once "config.php";

// Defining variables and initialize with empty values
$name = $fats = $carbs = $protein = "";
$name_err = $fats_err = $carbs_err = $protein_err = "";

// processing information from forms after submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $fats = floatval($input_fats);
    }

    // Validate carbs
    $input_carbs = trim($_POST["carbs"]);
    if (!is_numeric($input_carbs) || $input_carbs < 0) {
        $carbs_err = "Please enter a non-negative numeric value.";
    } else {
        $carbs = floatval($input_carbs);
    }

    // Validate protein
    $input_protein = trim($_POST["protein"]);
    if (!is_numeric($input_protein) || $input_protein < 0) {
        $protein_err = "Please enter a non-negative numeric value.";
    } else {
        $protein = floatval($input_protein);
    }

    // Before entering into the database, check for input errors
    if (empty($name_err) && empty($fats_err) && empty($carbs_err) && empty($protein_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO foodlist (name, fats, carbs, protein) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_fats, $param_carbs, $param_protein);

            // Set parameters
            $param_name = $name;
            $param_fats = $fats;
            $param_carbs = $carbs;
            $param_protein = $protein;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to the landing page
                header("location: foodlist.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div id="logo">
        <!-- Logo -->
        <img src="IMG/Logo.PNG" alt="main_logo..." class="logo" />
    </div>

<body>
    <!-- Create Record container -->
    <div class="wrapper">
                    <h2 class="mt-5">Create Record</h2>

                    <!-- Form for creating a new record -->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>

                        <!-- For fats -->
                        <div class="form-group">
                            <label>Fats</label>
                            <input name="fats" class="form-control <?php echo (!empty($fats_err)) ? 'is-invalid' : ''; ?>"><?php echo $fats; ?>
                            <span class="invalid-feedback"><?php echo $fats_err; ?></span>
                        </div>
                        <!-- For carbs -->
                        <div class="form-group">
                            <label>Carbs</label>
                            <input type="carbs" name="carbs" class="form-control <?php echo (!empty($carbs_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $carbs; ?>">
                            <span class="invalid-feedback"><?php echo $carbs_err; ?></span>
                        </div>
                        <!-- For protein -->
                        <div class="form-group">
                            <label>Protein</label>
                            <input type="protein" name="protein" class="form-control <?php echo (!empty($protein_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $protein; ?>">
                            <span class="invalid-feedback"><?php echo $protein_err; ?></span>
                        </div>
                        <!-- Go back to foodlist or submit -->
                        <input type="submit" class="btn" value="+ Submit">
                        <a href="foodlist.php" class="btn">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<style>
        body { background-color: #CEB992; }
        .wrapper{ max-width: 400px; margin: 50px auto; padding: 20px; }
        .logo { width: 140px; position: absolute; top: 55px; left: 10px; border-radius: 20px;}
        .btn {background-color: #5B2E48; color:#fff;}
    </style>
    
</html>