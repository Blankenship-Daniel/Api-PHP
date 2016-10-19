<?php require_once('../layouts/header.php') ?>
<?php require_once('../db/dbConnect.php') ?>
<?php require_once('../db/DBPantry.php') ?>

<div class="container">
    <h1>PHP Database Modification</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="boxed">
                <label for="food_types">Food types: </label>
                <select onchange="getFoodByFoodType(this.value)" name="food_types" id="food_types">
                <?php
                    $db = new DBPantry($conn);
                    $food_types = $db->getAllFoodTypes();

                    foreach ($food_types as $food_type) {
                        echo "<option value='" . $food_type['id'] . "'>" .
                            strtolower(str_replace("_", " ", $food_type['name'])) .
                            "</option>";
                    }

                    mysqli_close($conn);
                ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="boxed">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Food Name
                            </th>
                            <th>
                                Expiration Date
                            </th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <tbody id="foods"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once('../layouts/footer.php') ?>
