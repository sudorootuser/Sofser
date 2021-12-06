<?php

session_start();

unset($_SESSION["compras"]);
$_SESSION["compras"] = [];

header("Location: ../../View/comprar/create.php?status=2");
?>