<?php
if(!isset($_GET["indice"])) return;
$indice = $_GET["indice"];

session_start();
array_splice($_SESSION["compras"], $indice, 1);
header("Location: ../../view/comprar/create.php?status=3");
?>