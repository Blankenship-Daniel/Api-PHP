<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>My Api</title>
   </head>
   <body>
      <h1>My Api</h1>
      <?php
        require_once('../RecipesApi.class.php');

        try {
            $api = new RecipesApi($_REQUEST);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
      ?>
   </body>
</html>
