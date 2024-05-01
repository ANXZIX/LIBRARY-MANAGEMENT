
<?php

if (!isset($_SESSION['username']) || $_SESSION['username'] != 'student') {
    header('Location: index.php'); // Redirect to login page if not logged in as student
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
</head>
<body>
    <h2>WELCOME STUDENT</h2>
    <a href="logout.php">Logout</a>
    
    <h3>Book List</h3>
    <?php
    include 'db_connection.php';

    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Title: " . $row["title"]. " - Author: " . $row["author"]. " - Quantity: " . $row["quantity"]. "</li>";
        }
        echo "</ul>";
    } else {
        echo "No books available.";
    }

    $conn->close();
    ?>
</body>
</html>
