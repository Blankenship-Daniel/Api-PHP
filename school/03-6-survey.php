<?php require_once('../layouts/header.php') ?>

<div class="container">

    <h1>Survey</h1>

    <form action="03-6-survey-results.php" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="boxed">
                        <h4>Do you think college puts you ahead in life?</h4>
                        <input type="radio" name="college_choice" value="Yes"> Yes<br>
                        <input type="radio" name="college_choice" value="No"> No<br>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="boxed">
                        <h4>What would you like to do for a career?</h4>
                        <input type="text" name="career_choice" placeholder="career choice">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="boxed">
                        <h4>How much would you need to make to feel comfortable in this career?</h4>
                        <input type="checkbox" name="earnings[]" value="Less than 30,000"> Less than 30,000<br>
                        <input type="checkbox" name="earnings[]" value="More than 30,000 less than 60,000"> More than 30,000 less than 60,000<br>
                        <input type="checkbox" name="earnings[]" value="More than 60,000 less than 100,000"> More than 60,000 less than 100,000<br>
                        <input type="checkbox" name="earnings[]" value="More than 100,000"> More than 100,000<br>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="boxed">
                        <h4>What matters most to you in your career?</h4>
                        <select name="fulfillment_choice">
                            <option value="Making More Money">Making More Money</option>
                            <option value="Feeling Fulfilled">Feeling Fulfilled</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="boxed no-style">
                    <input type="submit" class="btn btn-success" value="Submit Survey">
                </div>
            </div>
        </div>
    </form>

</div>


<?php require_once('../layouts/footer.php') ?>
