<?php
session_start();
require_once('../db/dbConnect.php');
require_once('../db/DBUser.php');

$db = new DBUser($conn);
$response = $db->authUser($_POST['email'], $_POST['password']);

if ($response) {
    echo 'user authed';
} else {
    echo 'user not authed';
}
die;
?>
