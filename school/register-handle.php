<?php
session_start();
require_once('../db/dbConnect.php');
require_once('../db/DBUser.php');

$db = new DBUser($conn);
$response = $db->registerUser($_POST['email'], $_POST['password']);

if ($response) {
    echo 'Successfully created user<br>';
} else {
    echo 'Failed to create user<br>';
}
echo $_POST['redirect'] . '<br>';
?>
