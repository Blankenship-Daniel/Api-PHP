<?php
$db = new Silex\Application();
$db['debug'] = true;

$dbopts = parse_url(getenv('DATABASE_URL'));

$db->register(new Herrera\Pdo\PdoServiceProvider(), array(
      'pdo.dsn' => 'pgsql:dbname=' . ltrim($dbopts["path"],'/') . ';host='.$dbopts["host"] . ';port=' . $dbopts["port"],
      'pdo.username' => $dbopts["user"],
      'pdo.password' => $dbopts["pass"]
   )
);
?>
