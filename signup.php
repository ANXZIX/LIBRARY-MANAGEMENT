<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming form submitted, process the registration
    if ($_POST['user_type'] == 'admin') {
        // Handle admin registration
        // Here, you can ask for admin-specific details like username and password
        // Process the form data accordingly
    } elseif ($_POST['user_type'] == 'student') {
        // Handle student registration
        // Here, you can ask for student-specific details like Students_id, Name, DOB, Gender, etc.
        // Process the form data accordingly
        $student_id = $_POST['student_id'];
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $department = $_POST['department'];
        $semester = $_POST['semester'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        
        // Perform database insertion or other operations with the collected data
        // Example:
        // $sql = "INSERT INTO students (Students_id, Name, DOB, Gender, Department, Semester, Email, Address) VALUES ('$student_id', '$name', '$dob', '$gender', '$department', '$semester', '$email', '$address')";
        // Execute the SQL query
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Sign Up</title>
</head>
<body>
    <h2>Student Sign Up</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="user_type" value="student"> <!-- Hidden field to store the selected user type -->
        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" required><br>
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>
        <label for="dob">DOB:</label>
        <input type="date" name="dob" required><br>
        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>
        <label for="department">Department:</label>
        <input type="text" name="department" required><br>
        <label for="semester">Semester:</label>
        <input type="text" name="semester" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="address">Address:</label>
        <textarea name="address" required></textarea><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>

