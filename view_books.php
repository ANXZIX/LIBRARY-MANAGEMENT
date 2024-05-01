<?php
include 'db_connection.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Title: " . $row["title"]. " - Author: " . $row["author"]. " - Quantity: " . $row["quantity"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<!-- Back button to redirect to admin library page -->
<a href="admin_library.php">Back to Admin Library</a>