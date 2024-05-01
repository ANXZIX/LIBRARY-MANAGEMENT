<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Update the quantity by decrementing it by 1
    $sql = "UPDATE books SET quantity = quantity - 1 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Check if the quantity becomes zero
        $sql_check = "SELECT quantity FROM books WHERE id = $id";
        $result_check = $conn->query($sql_check);
        
        if ($result_check->num_rows > 0) {
            $row_check = $result_check->fetch_assoc();
            if ($row_check["quantity"] == 0) {
                // Delete the book if quantity becomes zero
                $sql_delete = "DELETE FROM books WHERE id = $id";
                if ($conn->query($sql_delete) === TRUE) {
                    echo "<div class='alert alert-success' role='alert'>Book deleted successfully</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Error deleting book: " . $conn->error . "</div>";
                }
            } else {
                echo "<div class='alert alert-success' role='alert'>Quantity decremented successfully</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error decrementing quantity: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Decrement Book Quantity</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Book ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Retrieve all books from the database
                    $sql = "SELECT * FROM books";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo $row["author"]; ?></td>
                                <td><?php echo $row["quantity"]; ?></td>
                                <td>
                                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                                        <button type="submit" class="btn btn-danger">Decrement</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No books found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Back button to redirect to admin library page -->
        <a href="admin_library.php" class="btn btn-secondary my-3">Back to Admin Library</a>
    </div>
</body>
</html>
