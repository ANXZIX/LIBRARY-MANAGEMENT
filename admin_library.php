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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .welcome {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <h2>Admin Panel</h2>

        <div class="list-group">
            <a href="add_book.php" class="list-group-item list-group-item-action">Add Book</a>
            <a href="view_books.php" class="list-group-item list-group-item-action">View Books</a>
            <a href="edit_book.php" class="list-group-item list-group-item-action">Edit Book</a>
            <a href="delete_book.php" class="list-group-item list-group-item-action">Delete Book</a>
            <a href="view_students.php" class="list-group-item list-group-item-action">View Students</a>
        </div>
    </div>
</body>
</html>
