<?php
require_once('dbConnect.php');
require_once('DBPantry.php');

$db = new DBPantry($conn);

if (isset($_POST['request']) && $_POST['request'] == 'getFoodByFoodType') {
    $data = $db->getFoodByFoodType($_POST['id']);
} else if (isset($_POST['request']) && $_POST['request'] == 'deleteFoodItem') {
    $data = $db->deleteFoodItem($_POST['id']);
} else if (isset($_POST['request']) && $_POST['request'] == 'addFoodItem') {
    $data = $db->addFoodItem($_POST['foodName'], $_POST['foodType'], $_POST['expDate']);
} else if (isset($_POST['request']) && $_POST['request'] == 'getAllFoods') {
    $data = $db->getAllFoods();
}


mysqli_close($conn);
echo json_encode($data);
?>
