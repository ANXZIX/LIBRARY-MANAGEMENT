<?php
include 'db_connection.php';

// Fetch all books from the database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $quantity = $_POST['quantity'];

    $sql_update = "UPDATE books SET title='$title', author='$author', quantity=$quantity WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    exit; // Terminate script execution after handling the POST request
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Edit Book</h2>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div id='book{$row["id"]}'>";
                echo "<form id='form{$row["id"]}' method='post'>";
                echo "Book ID: <input type='hidden' name='id' value='{$row["id"]}'>";
                echo "Title: <input type='text' name='title' value='{$row["title"]}' required><br>";
                echo "Author: <input type='text' name='author' value='{$row["author"]}' required><br>";
                echo "Quantity: <input type='number' name='quantity' value='{$row["quantity"]}' required><br>";
                echo "<input type='submit' value='Edit Book'>";
                echo "</form>";
                echo "</div>";
                echo "<script>
                        $('#form{$row["id"]}').submit(function(e) {
                            e.preventDefault(); // Prevent form submission
                            $.ajax({
                                type: 'POST',
                                url: 'edit_book.php',
                                data: $('#form{$row["id"]}').serialize(),
                                success: function(response) {
                                    $('#book{$row["id"]}').html(response); // Update container with edited content
                                }
                            });
                        });
                    </script>";
            }
        } else {
            echo "No books found";
        }
        ?>
        <!-- Back button to redirect to admin library page -->
        <a href="admin_library.php">Back to Admin Library</a>
    </div>
</body>
</html>
