<?php
session_start();
require_once('../db/dbConnect.php');
require_once('../db/DBUser.php');

$db = new DBUser($conn);
$response = $db->registerUser($_POST['email'], $_POST['password']);

if ($response) {
    $_SESSION['auth'] = true;
    header('Location: ' . $_POST['redirect']);
} else {
    die('Failed to create user');
}
?>
