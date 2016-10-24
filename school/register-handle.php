<?php
session_start();
require_once('../db/dbConnect.php');
require_once('../db/DBUser.php');

$db = new DBUser($conn);
$response = $db->registerUser($_POST['email'], $_POST['password']);

if ($response) {
    header('Location: ' . $_POST['redirect']);
}

die('Failed to register user...');
?>
