<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "../../Model/base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM producto WHERE idProducto = ?;");
$resultado = $sentencia->execute([$id]);
if($resultado === TRUE){
    header("Location: ../../View/productos/read.php");
	exit;
}
else echo "Algo salió mal";
?>