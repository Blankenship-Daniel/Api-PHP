<?php require_once('../layouts/header.php') ?>
<?php require_once('../db/dbConnect.php') ?>
<?php require_once('../db/DBPantry.php') ?>

<div class="container">
    <h1>Database Setup</h1>
    <div class="boxed">
        <?php
            $db = new DBPantry($conn);
            $food_types = $db->getAllFoodTypes();

            foreach ($food_types as $food_type) {
                echo "<pre>";
                var_dump($food_type);
                echo "</pre>";
            }
        ?>
    </div>
</div>

<?php require_once('../layouts/footer.php') ?>
