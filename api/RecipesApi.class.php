<?php
require_once('Api.class.php');
class RecipesApi extends Api {
    public function __construct($request) {
        echo '<pre>';
        var_dump($request);
        echo '</pre>';

        // parent::__construct($request);
    }
}
?>
