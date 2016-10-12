<?php
require_once('dbConnect.php');
require_once('DBPantry.php');

$db = new DBPantry($conn);

if (isset($_POST['request']) && $_POST['request'] == 'getFoodById') {
    $data = $db->getFoodById($_POST['id']);
}

mysqli_close($conn);
echo json_encode($data);
?>
