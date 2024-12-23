<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <div id="logo">
        <!-- HealthHarbor logo -->
        <img src="IMG/Logo.PNG" alt="main_logo..." class="logo" />
    </div>

    <!-- Tooltip initialization script -->
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function () {
            // Click event on the "Add Item" button
            $('.add-item-btn').click(function () {
                // Get the item ID from the data-id attribute
                var itemId = $(this).data('id');

                // Send an AJAX request to add the item to todayslist
                $.ajax({
                    url: 'addtotodayslist.php',
                    type: 'POST',
                    data: { itemId: itemId },
                    success: function (response) {
                        // Handle the response, e.g., show a success message
                        alert(response);
                    },
                    error: function (error) {
                        // Handle errors, e.g., show an error message
                        alert('Error adding item to todayslist: ' + error.responseText);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <!-- Main content wrapper -->
    <div class="wrapper">
                    <!-- Header section -->
                    <div class="mt-5 mb-3 clearfix">
                        <h2>Here's The FoodList</h2>
                        <a href="construct.php" class="btn btn-primary">+ Add Food Item To The List</a>
                    </div>

                    <!-- FoodList table -->
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
$sql = "SELECT * FROM foodlist";
if ($result = mysqli_query($link, $sql)) {
    // Check if there are any rows in the result
    if (mysqli_num_rows($result) > 0) {
        // Display a table if there are rows
        echo '<table class="table table-bordered table-striped">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Fats</th>";
        echo "<th>Carbs</th>";
        echo "<th>Protein</th>";
        echo "<th>Edit/Delete/Add to Today's List</th>"; // Corrected spelling
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Loop through each row in the result set
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            // Display data from each column in the row
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['fats'] . "</td>";
            echo "<td>" . $row['carbs'] . "</td>";
            echo "<td>" . $row['protein'] . "</td>";
            echo "<td>";
            // Create links for editing and deleting records
            echo '<a href="edit.php?id=' . $row['id'] . '" class="mr-3" title="Edit Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
            echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
            // Add data-id attribute to the button to store the item's ID
            echo '<button class="btn btn-primary add-item-btn" data-id="' . $row['id'] . '">Add To Today\'s List</button>'; 
            echo "</td>";
            echo "</tr>";
        }
            echo "</tbody>";
            echo "</table>";
                // Free result set
                   mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
                        echo "Something went wrong. Please try again later.";
                    }
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper">
            <h2 class="pull-left">Go To Home Page Or TodaysList</h2>
            <!-- Add the Home Page and Todayslist button -->
            <a href="dashboard.php" class="btn btn-primary">Home Page</a>
            <a href="todayslist.php" class="btn btn-primary" style="margin-top: 15px;">Go To TodaysList</a>
        </div>
    </div>
</body>

</html>

<style>
        body { background-color: #CEB992; }
        .wrapper { max-width: 900px; margin: 10px auto; background-color:#B9D6F2; padding: 20px; border-radius: 30px;}
        th, td {text-align: center; }
        .btn-primary { width: 100%; background-color: #5B2E48; }
        .logo { width: 140px; position: absolute; top: 55px; left: 10px; border-radius: 20px; }
    </style>
    
