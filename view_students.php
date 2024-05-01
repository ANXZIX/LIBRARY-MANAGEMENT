<?php
session_start();
if ($_SESSION['username'] != 'admin') {
    header('Location: index.php');
    exit();
}

// Include database connection
include 'db_connection.php';

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    // Sanitize search input
    $search_query = sanitize_input($_POST["search_query"]);

    // Fetch student details from the database based on search query
    $sql = "SELECT * FROM student WHERE Name LIKE '%$search_query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='container'>";
        echo "<h2>Search Results</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='thead-dark'>";
        echo "<tr><th>ID</th><th>Name</th><th>DOB</th><th>Gender</th><th>Email</th><th>Address</th><th>Semester</th><th>Department</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["Students_id"]."</td>";
            echo "<td>".$row["Name"]."</td>";
            echo "<td>".$row["DOB"]."</td>";
            echo "<td>".$row["Gender"]."</td>";
            echo "<td>".$row["Email"]."</td>";
            echo "<td>".$row["Address"]."</td>";
            echo "<td>".$row["Semester"]."</td>";
            echo "<td>".$row["Department"]."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "No results found";
    }
} else {
    // Fetch all students
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='container'>";
        echo "<h2>Student List</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered'>";
        echo "<thead class='thead-dark'>";
        echo "<tr><th>ID</th><th>Name</th><th>DOB</th><th>Gender</th><th>Email</th><th>Address</th><th>Semester</th><th>Department</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["Students_id"]."</td>";
            echo "<td>".$row["Name"]."</td>";
            echo "<td>".$row["DOB"]."</td>";
            echo "<td>".$row["Gender"]."</td>";
            echo "<td>".$row["Email"]."</td>";
            echo "<td>".$row["Address"]."</td>";
            echo "<td>".$row["Semester"]."</td>";
            echo "<td>".$row["Department"]."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "No students found";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Search Students</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mb-4">
            <div class="form-row">
                <div class="col-auto">
                    <input type="text" name="search_query" class="form-control" placeholder="Search by name">
                </div>
                <div class="col-auto">
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <h2>Add New Student</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dob">DOB:</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <input type="text" name="semester" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" name="department" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Student</button>
        </form>
    </div>
</body>
</html>
