<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO books (title, author, quantity) VALUES ('$title', '$author', $quantity)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!-- HTML form to add a new book -->
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    Title: <input type="text" name="title" required><br>
    Author: <input type="text" name="author" required><br>
    Quantity: <input type="number" name="quantity" required><br>
    <input type="submit" value="Add Book">
</form>

<!-- Back button to redirect to admin_library.php -->
<a href="admin_library.php">Back</a>
