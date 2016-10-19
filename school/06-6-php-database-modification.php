<?php require_once('../layouts/header.php') ?>
<?php require_once('../db/dbConnect.php') ?>
<?php require_once('../db/DBPantry.php') ?>

<div class="container">
    <h1>PHP Database Modification</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="boxed">
                <h3>Add food</h3>
                <label for="food_name">Food name: </label>
                <input type="text" name="add_food_name" id="add_food_name" value="" placeholder="Cheese">
                <label for="add_food_type">Food type: </label>
                <select name="add_food_type" id="add_food_type">
                <?php
                    $db = new DBPantry($conn);
                    $food_types = $db->getAllFoodTypes();

                    foreach ($food_types as $food_type) {
                        echo "<option value='" . $food_type['id'] . "'>" .
                            strtolower(str_replace("_", " ", $food_type['name'])) .
                            "</option>";
                    }
                ?>
                </select>
                <label for="add_exp_date">Expiration Date: </label>
                <input type="text" name="add_exp_date" id="add_exp_date" value="" placeholder="YYYY-MM-DD">
                <br>
                <button onclick="addFood()" class="btn">Add Food</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="boxed">
                <h3>Select food type</h3>
                <label for="food_types">Food types: </label>
                <select onchange="getFoodByFoodType(this.value)" name="food_types" id="food_types">
                <?php
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
                <h3>Foods</h3>
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
