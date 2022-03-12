<?php 
// DB credentials.
// define('DB_HOST','localhost');
// define('DB_USER','root');
// define('DB_PASS','');
// define('DB_NAME','petsociety');
// Establish database connection.
try
{
$con = new PDO('mysql:host=localhost;dbname=petsociety;charset=utf8', 'root', '');
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}



?>