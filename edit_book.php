<?php
include 'db_connection.php';

// Fetch all books from the database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if search form is submitted
    if(isset($_POST['search'])) {
        $search = $_POST['search'];
        // Modify the SQL query to include search filter
        $sql = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%'";
        $result = $conn->query($sql);
    } else {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $quantity = $_POST['quantity'];

        $sql_update = "UPDATE books SET title='$title', author='$author', quantity=$quantity WHERE id=$id";

        if ($conn->query($sql_update) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Record updated successfully</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error updating record: " . $conn->error . "</div>";
        }
        exit; // Terminate script execution after handling the POST request
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Edit Book</h2>
        <!-- Search Form -->
        <form method="post" class="mb-4">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Search by Title or Author">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="card my-3">
                    <div class="card-body">
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="author">Author:</label>
                                <input type="text" class="form-control" id="author" name="author" value="<?php echo $row['author']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Edit Book</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class='alert alert-warning' role='alert'>No books found</div>";
        }
        ?>
        <!-- Back button to redirect to admin library page -->
        <a href="admin_library.php" class="btn btn-secondary my-3">Back to Admin Library</a>
    </div>
</body>
</html>
