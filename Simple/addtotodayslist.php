<?php
// Include config file
require_once "config.php";

// Check if the item ID is set
if (isset($_POST["itemId"])) {
    // Get the item ID from the POST data
    $itemId = $_POST["itemId"];

    // Retrieve the chosen item from the food list
    $select_query = "SELECT * FROM foodlist WHERE id = $itemId";
    $result = mysqli_query($link, $select_query);

    // Check if the query successfully retrieved a row
    if ($row = mysqli_fetch_assoc($result)) {
        // Insert the selected item into today's list
        $insert_query = "INSERT INTO todayslist (name, fats, carbs, protein) VALUES ('{$row['name']}', '{$row['fats']}', '{$row['carbs']}', '{$row['protein']}')";
        
        // Check if the insertion query is successful
        if (mysqli_query($link, $insert_query)) {
            echo 'Item has been added.';
        } else {
            // Display an error message if the insertion fails
            echo 'Error adding item to today\'s list: ' . mysqli_error($link);
        }
    } else {
        // Display an error message if fetching the item from foodlist fails
        echo 'Error fetching item from foodlist.';
    }
} else {
    // Display a message if the item ID is not provided
    echo 'Item ID not provided.';
}

// Close connection
mysqli_close($link);
?>

