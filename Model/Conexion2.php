<?php
$DB_HOST="localhost";
$DB_NAME= "sofser";
$DB_USER= "root";
$DB_PASS= "";
	# conectare la base de datos
    $conn=@mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if(!$conn){
        die("imposible conectarse: ".mysqli_error($conn));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }

?>
