<?php
if($_SESSION['username'] == 'admin') {
    include 'admin_library.php';
} elseif ($_SESSION['username'] == 'student') {
    include 'student_library.php';
}
?>
