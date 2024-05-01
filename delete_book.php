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
                    echo "Book deleted successfully";
                } else {
                    echo "Error deleting book: " . $conn->error;
                }
            } else {
                echo "Quantity decremented successfully";
            }
        }
    } else {
        echo "Error decrementing quantity: " . $conn->error;
    }
}
?>

<!-- Display all books with decrement buttons -->
<h2>Decrement Book Quantity</h2>
<table border="1">
    <tr>
        <th>Book ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>
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
                        <input type="submit" value="Decrement">
                    </form>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='5'>No books found</td></tr>";
    }
    ?>
</table>

<!-- Back button to redirect to admin library page -->
<a href="admin_library.php">Back to Admin Library</a>