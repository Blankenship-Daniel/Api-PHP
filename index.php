<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>My App</title>
   </head>
   <body>
      <h1>Hello World</h1>
      <?php
         $app->register(new Herrera\Pdo\PdoServiceProvider(),
            array(
               'pdo.dsn'      => 'pgsql:dbname=' .
                                 ltrim($dbopts["path"],'/') .
                                 ';host='.$dbopts["host"] .
                                 ';port=' . $dbopts["port"],
               'pdo.username' => $dbopts["user"],
               'pdo.password' => $dbopts["pass"]
            )
         );

         echo '<pre>';
         var_dump($dbopts);
         echo '</pre>';
      ?>
   </body>
</html>
