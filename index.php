<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
            session_start();
            if(isset($_SESSION['username'])) {
                include 'library.php';
            } else {
                include 'login.php';
            }
        ?>
    </div>
</body>
</html>
