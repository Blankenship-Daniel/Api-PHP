<?php if (!isset($_SESSION)) session_start() ?>
<?php require_once('process-form.php') ?>
<?php require_once('survey-write-file.php') ?>
<?php require_once('../layouts/header.php') ?>

<div class="container">
    <h1>Survey Results</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="boxed">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Do you think college puts you ahead in life?</th>
                            <th>What would you like to do for a career?</th>
                            <th>How much would you need to make to feel comfortable in this career?</th>
                            <th>What matters most to you in your career?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo get_form_request('college_choice') ?>
                            </td>
                            <td>
                                <?php echo get_form_request('career_choice') ?>
                            </td>
                            <td>
                                <?php
                                    echo '<ul>';
                                    if (get_form_request('earnings') !== '') {
                                        foreach (get_form_request('earnings') as $earning) {
                                            echo "<li>$earning</li>";
                                        }
                                    }
                                    echo '</ul>';
                                ?>
                            </td>
                            <td>
                                <?php echo get_form_request('fulfillment_choice') ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once('../layouts/footer.php') ?>
