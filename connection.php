
<?php
try{
ini_set("display_errors", TRUE);
define('DB_HOST', getenv('DB_HOST')); //ENSURES THE DB CONNECTION//
define('DB_PORT', getenv('DB_PORT')); 
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));
define('DB_NAME', getenv('DB_NAME'));
$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT;
$db = new PDO($dsn, DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
      $e->getMessage();
}
?> 
