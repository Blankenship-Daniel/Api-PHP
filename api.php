<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>My Api</title>
   </head>
   <body>
      <h1>My Api</h1>
      <?php
      require 'api/Api.php';

      try {
         $api = new Api($_GET);
      } catch (Exception $e) {
         echo $e->getMessage();
      }
      ?>
   </body>
</html>
