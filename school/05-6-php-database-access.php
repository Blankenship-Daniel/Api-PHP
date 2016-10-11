<?php require_once('../layouts/header.php') ?>
<?php require_once('../db/dbConnect.php') ?>
<?php require_once('../db/DBPantry.php') ?>

<div class="container">
    <h1>Database Setup</h1>
    <div class="boxed">
        <?php
            $db = new DBPantry($conn);
            echo "<pre>";
            echo $db->getAllFoodTypes();
            echo "</pre>";
        ?>
    </div>
</div>

<?php require_once('../layouts/footer.php') ?>
