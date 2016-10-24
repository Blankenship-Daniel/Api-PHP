<?php require_once('../layouts/header.php') ?>
<?php require_once('../db/dbConnect.php') ?>
<?php require_once('../db/DBPantry.php') ?>

<div class="container">
    <h1>User Login</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="boxed form-group">
                <label for="email">Email: </label>
                <input type="text" name="email" placeholder="john@doe.com" class="form-control">
                <label for="password">Password: </label>
                <input type="password" name="password" class="form-control">
            </div>
        </div>
    </div>
</div>

<?php require_once('../layouts/footer.php') ?>
