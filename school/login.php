<?php require_once('../layouts/header.php') ?>

<div class="container">
    <h1>User Login</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="boxed">
                <h3>Not a user?</h3>
                <p><a href="register.php?<?php echo $_GET['redirect'] ?>">Click here to register.</a></p>
            </div>
        </div>
        <div class="col-md-12">
            <form class="" action="login-handle.php" method="post">
                <input type="hidden" name="redirect" value="<?php echo $_GET['redirect'] ?>">
                <div class="boxed">
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" name="email" placeholder="john@doe.com" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../layouts/footer.php') ?>
