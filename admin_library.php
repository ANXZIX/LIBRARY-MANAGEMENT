<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['username'] != 'admin') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="welcome">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <a href="logout.php">Logout</a>
        </div>

        <h2>Admin Panel</h2>

        <ul>
            <li><a href="add_book.php">Add Book</a></li>
            <li><a href="view_books.php">View Books</a></li>
            <li><a href="edit_book.php">Edit Book</a></li>
            <li><a href="delete_book.php">Delete Book</a></li>
        </ul>
    </div>
</body>
</html>
