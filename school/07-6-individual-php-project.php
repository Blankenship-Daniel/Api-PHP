<?php session_start() ?>
<?php if (!$_SESSION || !$_SESSION['auth']) header('Location: login.php?redirect=07-6-individual-php-project.php') ?>
<?php require_once('../layouts/header.php') ?>
<?php require_once('../db/dbConnect.php') ?>
<?php require_once('../db/DBPantry.php') ?>

<div class="container">
    <h1>Food Pantry</h1>
    <div class="row">
        <div class="col-md-12">
            <form id="addFoodForm">
                <div class="boxed">
                    <h3>Add food</h3>
                    <div class="form-group">
                        <label for="add_food_name">Food name: </label>
                        <input maxlength="50" type="text" name="add_food_name" id="add_food_name" value="" class="form-control" placeholder="Cheese" required>
                    </div>
                    <div class="form-group">
                        <label for="add_food_type">Food type: </label>
                        <select name="add_food_type" id="add_food_type" class="form-control" required>
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
                    </div>
                    <div class="form-group">
                        <label for="add_exp_date">Expiration Date: </label>
                        <input maxlength="10" type="text" name="add_exp_date" id="add_exp_date" value="" class="form-control" placeholder="YYYY-MM-DD" required>
                    </div>
                    <button onclick="addFood(event)" class="btn btn-default">Add Food</button>
                </div>
            </form>
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
                                Food Type
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
<script src="/js/07-6-individual-php-project.js"></script>
