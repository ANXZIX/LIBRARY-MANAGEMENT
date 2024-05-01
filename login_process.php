<?php
session_start();

if($_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
    $_SESSION['username'] = $_POST['username'];
    header('Location: index.php');
} elseif ($_POST['username'] == 'student' && $_POST['password'] == 'student') {
    $_SESSION['username'] = $_POST['username'];
    header('Location: index.php');
} else {
    echo 'Invalid username or password.';
}
?>
