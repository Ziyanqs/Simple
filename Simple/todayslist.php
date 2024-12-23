<?php
// Include config file
require_once "config.php";

// Check if the form is submitted for removing items
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_items"])) {
    $selected_items = $_POST["selected_items"];

    if (!empty($selected_items)) {
        $selected_items_str = implode(", ", $selected_items);

        // Delete selected items from todayslist
        $delete_query = "DELETE FROM todayslist WHERE id IN ($selected_items_str)";
        if (mysqli_query($link, $delete_query)) {
            echo '<div class="alert alert-success">Selected items removed successfully.</div>';
        } else {
            echo '<div class="alert alert-danger">Error removing items: ' . mysqli_error($link) . '</div>';
        }
    }
}

// Function to calculate the sum of each column
function calculateColumnSum($result, $column)
{
    $sum = 0;
    while ($row = mysqli_fetch_array($result)) {
        $sum += $row[$column];
    }
    return $sum;
}

// Fetch today's food items
$sql = "SELECT * FROM todayslist";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TodaysFoodList</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div id="logo">
        <!-- Logo and heading-->
        <img src="IMG/Logo.PNG" alt="main_logo..." class="logo" />
    </div>

<body>
    <div class="container mt-5">
        <h2>TodaysFoodList</h2>

        <!-- Removing items -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <!-- Create table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Fats</th>
                        <th>Carbs</th>
                        <th>Protein</th>
                        <th>Select To Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['fats']}</td>";
                        echo "<td>{$row['carbs']}</td>";
                        echo "<td>{$row['protein']}</td>";
                        echo "<td><input type='checkbox' name='selected_items[]' value='{$row['id']}'></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <button type="submit" style="width: 41%; height: 70px; background-color: #5B2E48; color: #fff; " name="remove_items">Remove from TodaysList</button>
        </form>

        <!-- Sum of the nutritions -->
        <div class="mt-3">
            <?php
            $sum_query = "SELECT SUM(fats) as total_fats, SUM(carbs) as total_carbs, SUM(protein) as total_protein FROM todayslist";
            $sum_result = mysqli_query($link, $sum_query);
            $sum_row = mysqli_fetch_assoc($sum_result);
            echo "<p style='font-size: 20px;'>Total Fats: {$sum_row['total_fats']} g &nbsp;&nbsp; Total Carbs: {$sum_row['total_carbs']} g &nbsp;&nbsp; Total Protein: {$sum_row['total_protein']} g</p>";
            ?>
        </div>
    </div>

    <!-- Back to home and foodlist button -->
    <div class="container mt-3">
        <div class="row">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="mb-3">Back To The Home Page Or FoodList</h2>
                    <a href="dashboard.php" class="btn">Home Page</a>
                    <a href="foodlist.php" class="btn">Go To FoodList</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// Close connection
mysqli_close($link);
?>

<style>
        body { background-color: #CEB992; }
        table td { text-align: center; }
        .btn { width: 100%; background-color: #5B2E48; color:#fff; margin-top: 10px;}
        .logo { width: 140px; position: absolute; top: 55px; left: 10px; border-radius: 20px;}
    </style>