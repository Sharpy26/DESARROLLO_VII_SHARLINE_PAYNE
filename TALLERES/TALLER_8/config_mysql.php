<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'Panama_BD');
define('DB_PASSWORD', 'RDP507$%&!X');
define('DB_NAME', 'taller8_db');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn === false){
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}
?>